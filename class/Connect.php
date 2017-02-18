<?php
class Connect{

    //mysql 连接数据库
//	var $con;
//	var $myDatebase;
//	function __construct($server,$user,$pwd,$datebase,$port='3306',$charset='utf8'){
//		$this->con=@mysql_connect($server.':'.$port,$user,$pwd);
//		if(!$this->con){
//			die("连接数据库服务器失败");
//		}
//		$this->myDatebase=mysql_select_db($datebase,$this->con);
//		if(!$this->myDatebase){
//			die("连接数据库出错");
//		}
//		mysql_query("set names ".$charset);
//	}
	//var $myDatebase;

    //mysqli连接数据库


    public function __construct($server,$user,$pwd,$database,$port='3306',$charset='utf8')
    {
        $conn = mysqli_connect($server.':'.$port,$user,$pwd);
        if(!$conn){
            die('连接数据库服务器失败');
        }

        mysqli_select_db($conn,$database) or die('连接数据库失败');

        //mysqli_query($conn,"set names $charset");
        return $conn;
    }

	
}
?>