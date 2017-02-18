<?php
class CheckValue{
	function checkLen($name,$value,$len){
		if(strlen($value)>$len){
			alertAndBack(strlen($value).$name." 过长");
		}
	}
	function checkReg($name,$value,$reg){
		if(!preg_match($reg,$value)){
			alertAndBack($name." 格式错误");
		}
	}
	function checkRegAjax($value,$reg){
		if(!preg_match($reg,$value)){
			echo("alert('非法操作')");
			exit();
		}
	}
	function checkNull($name,$value){
		if($value==""){
			alertAndBack($name." 不能为空");
		}
	}	
}
?>