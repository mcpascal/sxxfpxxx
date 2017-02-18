<?php
define('DB_HOST','localhost');
define('DB_NAME','sxxfpxxx');
define('DB_USER','root');
define('DB_PWD','root');
define('DB_CHARSET','utf8');
define('DB_PORT','3306');


require_once '../class/MysqlDb.php';
$db = MysqlDb::getInstance(DB_HOST,DB_USER,DB_PWD,DB_NAME,DB_PORT,DB_CHARSET);
//var_dump($db);
