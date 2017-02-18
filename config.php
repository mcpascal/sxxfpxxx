<?php
//header("content-type:text/html;charset:utf-8");
//include 'class/Connect.php';
include 'config/config.php';
//require_once 'class/MMySQL.class.php';
include 'class/MysqlDb.php';


define('GI', str_replace("\\", '/', dirname(__FILE__)));
//$conn=new Connect(DB_HOST,DB_USER,DB_PWD,DB_NAME,DB_PORT);

$db = MysqlDb::getInstance(DB_HOST,DB_USER,DB_PWD,DB_NAME,DB_PORT,DB_CHARSET);

var_dump($db);
?>