<?php
include("include/Header.php");
include("include/function.php");
include("class/User.php");
include("data/UserData.php");
include("config.php");
include("Base.php");
if (!$webSetting->examOpen){
	alertAndBack("未到考试时间");
}
?>
<?php
$username = $_COOKIE["username"];
$pwd = $_COOKIE["pwd"];
$class = $_COOKIE["class"];
if(preg_match("/^[a-z0-9A-Z]{6,20}$/", $username) && preg_match("/^[a-z0-9A-Z]{32}$/", $pwd) && $class != ""){
	$userData=new UserData();
	$arr = $userData->login($username, $pwd);
	if(!$arr[0]){
		setcookie("username", "");
		setcookie("pwd", "");
		setcookie("class", "");
		gotoUrl("test.php");
	}
}else{
	setcookie("username", "");
	setcookie("pwd", "");
	setcookie("class", "");
	gotoUrl("test.php");
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
<link href="css/layout.css" rel="stylesheet" type="text/css" />
</head>

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
					<div class="kaoshi-1"><img src="images/kaoshi-3.gif" border="0" usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="2,5,218,178" href="test-2.php" />
<area shape="rect" coords="282,5,493,175" href="chaxun.php" />
</map><br/></div>
			  </div>
			</div>
		</Div>
	</div>
</div><br/>
<?php include("Bottom.php"); ?>
</body>
</html>
