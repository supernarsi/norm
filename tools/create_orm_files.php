<?php
require __DIR__ . '/../vendor/autoload.php';

use tools\creator;

// 获取 class name
fwrite(STDOUT, '请输入要创建的模型类名：');
$className = trim(fgets(STDIN));

// 获取 table name
fwrite(STDOUT, '请输入关联的数据表名（留空则不创建 Mapper）：');
$tableName = trim(fgets(STDIN));

// 获取目录路径
fwrite(STDOUT, '请输入目录（默认 app/orm）：');
$dirPath = trim(fgets(STDIN));
$dirPath = $dirPath ?: 'app/orm';

// 获取子目录路径
fwrite(STDOUT, '请输入子目录（留空则不生成子目录）：');
$subDir = trim(fgets(STDIN));

// 创建文件
$creator = new creator\OrmModelCreator($className, $tableName, $dirPath, $subDir);
$creator->createField();
if ($tableName) {
    $creator = new creator\OrmMapperCreator($className, $tableName, $dirPath, $subDir);
    $creator->createField();
}
