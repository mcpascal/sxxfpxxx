<?php
//include("../config.php");
include('../config/config.php');
include(GI."/include/Header.php");
include(GI."/include/Function.php");
include(GI."/class/AdminUser.php");
include(GI."/class/AdminUserLoginLog.php");
include(GI."/data/AdminUserData.php");
include(GI."/data/AdminUserLoginLogData.php");
include(GI."/include/CheckValue.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登陆</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/CheckValue.js"></script>
<script type="text/javascript">
function checkForm(obj){
	var checkValue=new CheckValue();
	if(!checkValue.checkReg("用户名",obj.userName.value,/^\w{5,15}$/))return false;
	if(!checkValue.checkReg("密码",obj.password.value,/^\w{5,15}$/))return false;
//	if(!checkValue.checkReg("验证码",obj.code.value,/^\w{4}$/))return false;
}
</script>
</head>
<?php
$act=isset($_GET["act"])?$_GET['act']:"";

if ($act=="login"){
	$userName=$_POST["userName"];
	$password=$_POST["password"];
	$code=$_POST['code'];
	//print_r($_SESSION);
	$checkValue=new CheckValue();
	$checkValue->checkReg("用户名",$userName,"/^\w{5,15}$/");
	$checkValue->checkReg("密码",$password,"/^\w{5,15}$/");
//	$checkValue->checkReg("验证码",$code,"/^\w{4}$/");
//	if(strtolower($code)!=strtolower($_SESSION["admin_code"])){
//		//echo $code ;
//		alertAndBack("验证码错误");
//	}
	$adminUser=new AdminUser($userName,md5($password));
	$adminUserData=new AdminUserData();
	$adminUser=$adminUserData->login($adminUser,getIp(),date("Y-m-d H:s:i"));
	if($adminUser->userName==""){
		alertAndBack("用户名或密码错误");
	}else{
		//session_register("adminUserName");
		//session_register("adminPower");
		//session_register("adminId");
		//session_register("adminPassword");
		//session_register("adminIfLeave");
		$_SESSION["adminUserName"]=($adminUser->userName);
		$_SESSION["adminPower"]=($adminUser->power);
		$_SESSION["adminId"]=($adminUser->id);
		$_SESSION["adminPassword"]=($adminUser->password);
		$_SESSION["adminIfLeave"]="0";
		alertAndGo("登陆成功","Index.php");
	}
}
?>
<body style="margin:0;">
<div class="divAll" align="center">
<div class="divZong" >
	<div class="aLoginDiv">
		<div class="aLoginDiv1">
			<form method="post" action="?act=login" name="form1" onSubmit="return checkForm(this);">
			<table cellpadding="0" cellspacing="0" border="0" style="float:left;">
				<tr>
					<td>用户名：</td>
					<td><input type="text" name="userName" class="aLoginTxt1" tabindex="1"/></td>
				</tr>
				<tr>
					<td>密&nbsp;&nbsp;码：</td>
					<td><input type="password" name="password" class="aLoginTxt1" tabindex="2"/></td>
				</tr>
<!--				<tr>-->
<!--					<td>验证码：</td>-->
<!--					<td>-->
<!--						<table cellpadding="0" cellspacing="0" border="0">-->
<!--							<tr>-->
<!--								<td><input type="text" name="code" class="aLoginCode" tabindex="3"  /></td>-->
<!--								<td><img width="100" height="30" src="captcha.php?--><?php //echo(rand(0,999))?><!--" onClick="javascript:this.src=this.src+'?'+Math.random();" alt="看不清？点击图片更换下一张" style="margin-left:10px;" /></td>-->
<!--							</tr>-->
<!--						</table>-->
<!--					</td>-->
<!--				</tr>-->
				<tr>
					<td></td>
					<td><input type="image" src="images/button.png" style="margin:15px 0 0 10px;"/></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
</div>
</body>
</html>
