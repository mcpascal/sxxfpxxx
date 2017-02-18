<?php

/**
 * Created by PhpStorm.
 * User: Pascal
 * Date: 2017/2/18
 * Time: 下午7:10
 */
class MysqlDb
{
    private $link;
    static private $instance;

    // 连接数据库
    private function __construct($host, $username, $password,)
    {
        $this->link = mysql_connect($host, $username, $password);
        $this->query("SET NAMES 'utf8'", $this->link);
        //echo mysql_errno($this->link) . ": " . mysql_error($link). "n";
        //var_dump($this->link);
        return $this->link;
    }
    private function __clone()
    {
    }
    public static function get_class_nmdb($host, $username, $password)
    {
        //$connector = new nmdb($host, $username, $password);
        //return $connector;

        if (FALSE == (self::$instance instanceof self)) {
            self::$instance = new self($host, $username, $password);
        }
        return self::$instance;
    }
    // 连接数据表
    public function select_db($database)
    {
        $this->result = mysql_select_db($database);
        return $this->result;
    }
    // 执行SQL语句
    public function query($query)
    {
        return $this->result = mysql_query($query, $this->link);
    }
    // 将结果集保存为数组
    public function fetch_array($fetch_array)
    {
        return $this->result = mysql_fetch_array($fetch_array, MYSQL_ASSOC);
    }
    // 获得记录数目
    public function num_rows($query)
    {
        return $this->result = mysql_num_rows($query);
    }
    // 关闭数据库连接
    public function close()
    {
        return $this->result = mysql_close($this->link);
    }

}
