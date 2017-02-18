<?php

/**
 * Created by PhpStorm.
 * User: Pascal
 * Date: 2017/2/18
 * Time: 下午7:10
 */
class MysqlDb
{
    public $link;
    public function __construct($db_host,$db_user,$db_pass,$db_name,$db_port=3306,$db_charset='utf8'){
        $this->link = mysql_connect($db_host.':'.$db_port,$db_user,$db_pass) or die('连接数据库失败');
        mysql_query('set names '.$db_charset);
        mysql_select_db($db_name);
    }

}
