<?php
require_once __DIR__ . '/autoload.php';

use NormTools\Creator\OrmModelCreator;
use NormTools\Creator\OrmMapperCreator;
use NormTools\Creator\OrmSelectorCreator;

// 获取 class name
fwrite(STDOUT, '请输入要创建的模型类名：');
$className = trim(fgets(STDIN));
if (!$className) {
    echo "模型名称不能为空\n";
    exit();
}

// 获取 table name
fwrite(STDOUT, '请输入关联的数据表名（可接受 database.table 形式）：');
$tableName = trim(fgets(STDIN));
if (!$tableName) {
    echo "数据表名不能为空\n";
    exit();
}

// 是否需要创建 Selector
while (true) {
    fwrite(STDOUT, '是否需要创建 Selector 类[Y/N]：');
    $createSelector = trim(fgets(STDIN));
    $createSelector = strtolower(trim($createSelector));
    if (!in_array($createSelector, ['', 'y', 'n'])) {
        echo "请输入 Y 或 N（不输入则默认为 Y）\n";
    } else {
        $createSelector = ($createSelector == 'y' || $createSelector == '');
        break;
    }
}

// 获取目录路径
fwrite(STDOUT, '请输入目录（默认 app/orm）：');
$dirPath = trim(fgets(STDIN));
$dirPath = $dirPath ?: 'app/orm';

// 获取子目录路径
fwrite(STDOUT, '请输入子目录（留空则不生成子目录）：');
$subDir = trim(fgets(STDIN));

try {
    // 创建 model
    $creator = new OrmModelCreator($className, $tableName, $dirPath, $subDir);
    if ($creator->createField()) {
        echo '[info] 创建 Model 类成功，文件：' . $creator->getResFilePath() . "\n";
    } else {
        echo "[error] 创建 Model 失败\n";
    }

    // 创建 mapper
    $creator = new OrmMapperCreator($className, $tableName, $dirPath, $subDir);
    if ($creator->createField()) {
        echo '[info] 创建 Mapper 类成功，文件：' . $creator->getResFilePath() . "\n";
    } else {
        echo "[error] 创建 Mapper 失败\n";
    }

    if ($createSelector) {
        // 创建 selector
        $creator = new OrmSelectorCreator($className, $tableName, $dirPath, $subDir);
        if ($creator->createField()) {
            echo '[info] 创建 Selector 类成功，文件：' . $creator->getResFilePath() . "\n";
        } else {
            echo "[error] 创建 Selector 失败\n";
        }
    }
} catch (Exception $e) {
    echo '[error] 执行失败：' . $e->getMessage() . "\n";
    exit();
}