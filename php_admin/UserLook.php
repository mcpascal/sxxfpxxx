<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/User.php");
include(GI."/data/UserData.php");
include(GI."/include/CheckLoginForAdmin.php");
include("BigImg.php");
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
<script type="text/javascript" src="js/Date.js"></script>
</head>
<?php
$id=$_GET["id"];
if(!is_numeric($id)){
	done(0);
}
$id=(int)$id;
$baomingData=new UserData();
$arr=$baomingData->getInfoById($id);
if(!$arr[0]){
	done(0);
}
?>

<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">会员查看</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="right" class="tdLeft" width="15%">用户名：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->username)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">姓名：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->realname)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">性别：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->sex)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">出生年月：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->birthday)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">身份证号：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->card)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">学历：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->education)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">职务：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->job)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">职称：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->title)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">工作单位：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->company)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">区县：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->county)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">地址：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->address)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">联系电话：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->phone)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">通讯地址：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->address1)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">邮编：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->zipcode)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">电子邮件：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->email)?></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">提交时间：</td>
		<td align="left" style="padding-left:5px;">&nbsp;<?php echo($arr[1]->addtime)?></td>
	</tr>
	<tr>
		<td align="center" class="tdLeft"></td>
		<td align="left" style="padding-left:5px;"><input type="button" onclick="window.history.back();" value="返回" class="button" /></td>
	</tr>
</table>
</div>
</body>
</html>
