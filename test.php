<?php
session_start();
include("include.php");
/*include("include/function.php");
include("config.php");
include("class/User.php");
include("data/UserData.php");
include("Base.php");
include("include/CheckValue.php");*/
header("Content-Type: text/html; charset=utf-8");
$classArr = explode("|", $webSetting->majorType);
$classStr = "";
foreach($classArr as $c){
	$classStr .= '<option value="' . $c . '">' . $c . '</option>';
}
?>
<?php
if (!$webSetting->examOpen){
	alertAndBack("未到考试时间");
}
$username = $_COOKIE["username"];
$pwd = $_COOKIE["pwd"];
if(preg_match("/^[a-z0-9A-Z]{6,20}$/", $username) && preg_match("/^[a-z0-9A-Z]{32}$/", $pwd)){
	$userData=new UserData();
	$arr = $userData->login($username, $pwd);
	if($arr[0]){
		gotoUrl("test-1.php");
	}else{
		setcookie("username", "");
		setcookie("pwd", "");
		setcookie("class", "");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线考试-<?php echo($webSetting->webName)?></title>
<meta name="keywords" content="<?php echo($webSetting->webKeyWords)?>">
<meta name="description" content="<?php echo($webSetting->webDescription)?>">
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/CheckValue.js"></script>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function checkForm(obj){
	var checkValue=new CheckValue();
	if(checkValue.checkNull(obj.username.value,"请填写用户名"))return false;
	if(!checkValue.checkReg(obj.username.value,/^[a-z0-9A-Z]{6,20}$/,"用户名格式错误"))return false;
	if(checkValue.checkNull(obj.pwd.value,"请填写密码"))return false;
	if(!checkValue.checkReg(obj.pwd.value,/^[a-z0-9A-Z]{6,20}$/,"密码格式错误"))return false;
	if(checkValue.checkNull(obj.code.value,"请填写验证码"))return false;
	if(!checkValue.checkReg(obj.code.value,/^[a-z0-9A-Z]{4}$/,"验证码格式错误"))return false;
}
</script>

</head>
<?php
$act=$_GET["act"];
if($act=="ok"){
	$CheckValue=new CheckValue();
	$CheckValue->checkNull("用户名",$_POST["username"]);
	$CheckValue->checkReg("用户名",$_POST["username"],"/^[a-z0-9A-Z]{6,20}$/");
	$CheckValue->checkNull("密码",$_POST["pwd"]);
	$CheckValue->checkReg("密码",$_POST["pwd"],"/^[a-z0-9A-Z]{6,20}$/");
	if(strtolower($_POST["code"])!=strtolower($_SESSION["userCode"])){
		alertAndBack("验证码错误");
	}
	$userData=new UserData();
	$arr = $userData->login($_POST["username"], md5($_POST["pwd"]));
	if($arr[0]){
		setcookie("username", $_POST["username"]);
		setcookie("pwd", md5($_POST["pwd"]));
		setcookie("class", $_POST["classname"]);
		gotoUrl("test-1.php");
	}else{
		alertAndBack("用户名或密码错误");
	}
	
}
?>
<body>
<?php include("Head.php"); ?>
<div class="main">
	<div class="main-1">
		<?php
		$headId = 7;
		include("Head1.php");
		?>
		<Div class="main-2">
			<div class="right-da">
				<div class="right-top" style="width:100%;">
					<div class="right-biao">在线考试</div>
					<div class="home"><img src="images/home.gif" />&nbsp;&nbsp;您当前位置：网站首页 > 在线考试</div>
				</div>
			  <div class="right-main-da">
			  	<table width="910" border="0" style="margin-top:50px;">
				  <tr>
					<td width=""><img src="images/denglv-1.gif" /></td>
					<td width="">
					<div class="denglv" style="width:409px">
						<form action="?act=ok" method="post" onsubmit="return checkForm(this)">
							<table width="" height="200" border="0" style="margin-top:70px; float:left; margin-left:30px;_margin-left:15px;">
							  <tr>
								<td width="">用户名：</td>
								<td width="">
								  <input type="text" name="username" /></td>
							  </tr>
							  <tr>
								<td>密　码：</td>
								<td><input type="password" name="pwd" /></td>
							  </tr>
							  <tr>
								<td>类　别：</td>
								<td><select class="select" name="classname"><?php echo $classStr;?></select></td>
							  </tr>
							  <tr>
								<td>验证码：</td>
								<td>
								  <table cellpadding="0" cellspacing="0" border="0"><tr><td><input name="code" type="text"  size="5"/></td><td valign="middle"><img width="100" height="30" src="Captcha.php?<?php echo(rand(0,999))?>" onClick="javascript:this.src=this.src+'?'+Math.random();" alt="看不清？点击图片更换下一张" style="margin-left:10px;" /><span style="color:#FF0000;">*</span></td></tr></table>
								</td>
							  </tr>
							  <tr>
								<td>&nbsp;</td>
								<td><input type="image" src="images/denglv-3.gif" width="103" height="37" border="0" />　<span style=" text-decoration:underline; font-weight:bold;"><a href="zhuce.php">注册</a></span></td>
							  </tr>
						  </table>
						</form>
					</div>
					</td>
				  </tr>
				</table><Br/><Br/>
			  </div>
			</div>
		</Div>
	</div>
</div><br/>
<?php include("Bottom.php"); ?>
</body>
</html>
