<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/class/AdminUser.php");
include(GI."/class/AdminUserLoginLog.php");
include(GI."/data/AdminUserLoginLogData.php");
include(GI."/class/WebSetting.php");
include(GI."/data/WebSettingData.php");
include(GI."/include/Function.php");
include(GI."/include/CheckLoginForAdmin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/Right.js"></script>
<title></title>
</head>

<body>
<div class="main">
	<div class="main1">
		<div class="main1Left"><img src="images/person.png" style="margin:18px;"/></div>
		<div class="main1Rihgt">
			<?php
			$webSettingData=new WebSettingData();
			$webSetting=$webSettingData->getInfo();
			?>
			<span class="main1RightUp">您好！欢迎使用<?php echo($webSetting->companyName);?>网站管理系统</span><br />
			当前用户：<?php echo($_SESSION["adminUserName"])?> <!--<a href="#">修改密码</a>-->
		</div>
	</div>
</div>

<div class="title" style="margin-top:10px;">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">常用功能</div>
	</div>
</div>
<div class="main2">
	<div class="main2Cell">
		<a href="AdminUserManage.php" target="main"><img src="images/bigimg/1.png" /></a>
		<div class="main2CellFont">账户管理</div>
	</div>
	
	<div class="main2Cell">
		<a href="WebSetting.php" target="main"><img src="images/bigimg/2.png" /></a>
		<div class="main2CellFont">系统设置</div>
	</div>
	
	<div class="main2Cell">
		<a href="MessageManage.php" target="main"><img src="images/bigimg/6.png" /></a>
		<div class="main2CellFont">留言管理</div>
	</div>
</div>
	
<div class="title" style="margin-top:0px;">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">我的登录日志</div>
	</div>
</div>
<div class="main3">
	<table cellpadding="0" cellspacing="0" border="0" width="500">
	<?php
	$adminUserLoginLogData=new AdminUserLoginLogData();
	$adminUser=new AdminUser($_SESSION["adminUserName"]);
	$arr=$adminUserLoginLogData->listByAdminUser($adminUser,7);
	for($i=0;$i<count($arr);$i++){
	?>
		<tr>
			<td align="center"><?php echo($arr[$i]->userName);?></td>
			<td align="center"><?php echo($arr[$i]->loginIp);?></td>
			<td align="center"><?php echo($arr[$i]->loginTime);?></td>
		</tr>
	<?php
	}
	?>
	</table>
</div>

</body>
</html>
