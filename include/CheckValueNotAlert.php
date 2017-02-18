<?php
class CheckValueNotAlert{
	function checkLen($name,$value,$len){
		if(strlen($value)>$len){
			die("<script type='text/javascript'>window.top.win1.win1Show(\"提示\",\"".$name."过长！\",\"\",false);window.top.bg.show();window.history.back();</script>");
		}
	}
	function checkReg($name,$value,$reg){
		if(!preg_match($reg,$value)){
			die("<script type='text/javascript'>window.top.win1.win1Show(\"提示\",\"".$name."格式错误！\",\"\",false);window.top.bg.show();window.history.back();</script>");
			alertAndBack($name." 格式错误");
		}
	}
	function checkRegAjax($value,$reg){
		if(!preg_match($reg,$value)){
			die("<script type='text/javascript'>window.top.win1.win1Show(\"提示\",\"操作失败！\",\"\",false);window.top.bg.show();window.history.back();</script>");
		}
	}
	function checkNull($name,$value){
		if($value==""){
			die("<script type='text/javascript'>window.top.win1.win1Show(\"提示\",\"".$name."不能为空！\",\"\",false);window.top.bg.show();window.history.back();</script>");
		}
	}	
	function message($message){
		die("<script type='text/javascript'>window.top.win1.win1Show(\"提示\",\"".$message."\",\"\",false);window.top.bg.show();window.history.back();</script>");
	}
}
?>