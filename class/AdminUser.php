<?php
class AdminUser{
	var $userName;
	var $password;//md5加密后
	var $id;
	var $power;//权限
	function __construct($userName="",$password="",$power="",$id=0){
		$this->userName=$userName;
		$this->password=$password;
		$this->id=$id;
		$this->power=$power;	
	}
}
?>