<?php
class AdminUserLoginLog{
	var $id;
	var $userName;
	var $loginIp;
	var $loginTime;
	function __construct($userName="",$loginIp="",$loginTime="",$id=0){
		$this->userName=$userName;
		$this->loginIp=$loginIp;
		$this->id=$id;
		$this->loginTime=$loginTime;	
	}
}
?>