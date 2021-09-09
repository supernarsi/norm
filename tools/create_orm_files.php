<?php
require __DIR__ . '/../vendor/autoload.php';

use tools\creator;

// 参数 1：类名，该类文件不存在时，会自动创建
$className = $argv[1] ?? '';
// 参数 2：数据库表名，当类中没有属性时，会将数据库中字段映射到类属性
$tableName = $argv[2] ?? '';
$dirName = $argv[3] ?? '';
$subDir = $argv[4] ?? '';

$creator = new creator\OrmModelCreator($className, $tableName, $dirName);
$creator->createField();
