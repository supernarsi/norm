<?php
require_once __DIR__ . '/autoload.php';

use NormTools\Creator\OrmModelCreator;
use NormTools\Creator\OrmMapperCreator;
use NormTools\Creator\OrmSelectorCreator;

printLnMsg('[Welcome to NORM Tool]');
// 获取 class name
fwrite(STDOUT, 'Input the class name of the model you want to create: ');
$className = trim(fgets(STDIN));
if (!$className) {
    printLnMsg('[error] Class name of model can\'t be empty', true);
}

// 获取 table name
fwrite(STDOUT, 'Input the table name associated with your model: ');
$tableName = trim(fgets(STDIN));
if (!$tableName) {
    printLnMsg('[error] Table name can\'t be empty', true);
}

// 是否需要创建 Selector
while (true) {
    fwrite(STDOUT, 'Do you need a Selector Class [Y/N]：');
    $createSelector = trim(fgets(STDIN));
    $createSelector = strtolower(trim($createSelector));
    if (!in_array($createSelector, ['', 'y', 'n'])) {
        printLnMsg('[warning] Please input Y or N（default by Y）');
    } else {
        $createSelector = ($createSelector == 'y' || $createSelector == '');
        break;
    }
}

// 获取目录路径
fwrite(STDOUT, 'Input the file path(default path is app/orm): ');
$dirPath = trim(fgets(STDIN));
$dirPath = $dirPath ?: 'app/orm';

// 获取子目录路径
fwrite(STDOUT, 'input the sub path: ');
$subDir = trim(fgets(STDIN));

try {
    // 创建 model
    $creator = new OrmModelCreator($className, $tableName, $dirPath, $subDir);
    if ($creator->createField()) {
        printLnMsg('[info] Create Model successfully: ' . $creator->getResFilePath());
    } else {
        printLnMsg('[error] Create Model failed');
    }

    // 创建 mapper
    $creator = new OrmMapperCreator($className, $tableName, $dirPath, $subDir);
    if ($creator->createField()) {
        printLnMsg('[info] Create Mapper successfully: ' . $creator->getResFilePath());
    } else {
        printLnMsg('[error] Create Mapper failed');
    }

    if ($createSelector) {
        // 创建 selector
        $creator = new OrmSelectorCreator($className, $tableName, $dirPath, $subDir);
        if ($creator->createField()) {
            printLnMsg('[info] Create Selector successfully: ' . $creator->getResFilePath());
        } else {
            printLnMsg('[error] Create Selector failed');
        }
    }
} catch (Exception $e) {
    printLnMsg('[error] exec failed: ' . $e->getMessage(), true);
}

function printLnMsg(string $msg, bool $exit = false): void
{
    echo $msg . PHP_EOL;
    if ($exit) {
        exit();
    }
}
