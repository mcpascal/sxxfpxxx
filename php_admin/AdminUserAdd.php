<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/AdminUser.php");
include(GI."/data/AdminUserData.php");
include(GI."/include/CheckValueNotAlert.php");
include(GI."/include/CheckLoginForAdmin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/Right.js"></script>
<script type="text/javascript" src="js/CheckValueNotAlert.js"></script>
<script type="text/javascript" src="js/Admin.js"></script>
<script type="text/javascript">
function checkAdd(obj){
	var checkValue=new CheckValueNotAlert();
	if(!checkValue.checkReg("账户",obj.userName.value,/^[a-z0-9A-Z]{5,15}$/))return false;
	if(!checkValue.checkReg("密码",obj.password.value,/^[a-z0-9A-Z]{5,15}$/))return false;
	if(!checkValue.checkEqual(obj.password.value,obj.password1.value,"两次密码输入不一致"))return false;
}
</script>
</head>
<?php
$act=$_GET["act"];
if($act=="add"){
	$CheckValueNotAlert=new CheckValueNotAlert();
	$CheckValueNotAlert->checkReg("账户",$_POST["userName"],"/^[a-z0-9A-Z]{5,15}$/");
	$CheckValueNotAlert->checkReg("密码",$_POST["password"],"/^[a-z0-9A-Z]{5,15}$/");
	$adminUser=new AdminUser($_POST["userName"],md5($_POST["password"]));
	$adminUserData=new AdminUserData();
	$arr=$adminUserData->getInfoByUserName($_POST["userName"]);
	if($arr[0]){
		$CheckValueNotAlert->message("账户重复");
	}
	$adminUserData->add($adminUser)?done(1,"AdminUserManage.php"):done(0);
}
?>
<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">管理员添加</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<form action="?act=add" method="post" name="form1" onsubmit="return checkAdd(this);">
	<tr>
		<td width="15%" align="right" class="tdLeft">管理员账户：</td>
		<td align="left"><input type="text" class="text" value="" name="userName"><span class="red">5-15字母数字组合</span></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">密码：</td>
		<td align="left"><input type="password" class="text" value=""  name="password"><span class="red">5-15字母数字组合</span></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">确认密码：</td>
		<td align="left"><input type="password" class="text" value=""  name="password1"><span class="red">5-15字母数字组合</span></td>
	</tr>
	<tr>
		<td></td>
		<td align="left"><input type="submit"   value="提交" class="button"></td>
	</tr>
	</form>
</table>
</body>
</html>
