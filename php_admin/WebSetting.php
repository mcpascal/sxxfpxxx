<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/WebSetting.php");
include(GI."/data/WebSettingData.php");
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
</head>

<?php
$act=$_GET["act"];
if($act=="ok"){
	$CheckValueNotAlert=new CheckValueNotAlert();
	$CheckValueNotAlert->checkLen("网站名称",$_POST["webName"],200);
	$CheckValueNotAlert->checkLen("公司名称",$_POST["companyName"],200);
	$CheckValueNotAlert->checkLen("网站地址",$_POST["webAddress"],200);
	$CheckValueNotAlert->checkLen("备案号",$_POST["webNumber"],200);
	$CheckValueNotAlert->checkLen("公司地址",$_POST["webCompanyAddress"],200);
	$CheckValueNotAlert->checkLen("联系电话",$_POST["webPhone"],200);
	$CheckValueNotAlert->checkLen("传真",$_POST["webFax"],200);
	$CheckValueNotAlert->checkLen("网站邮箱",$_POST["webEmail"],200);
/*	$CheckValueNotAlert->checkLen("网站邮箱密码",$_POST["webEmailPassword"],200);
	$CheckValueNotAlert->checkLen("网站邮箱Smtp",$_POST["webEmailSmtp"],200);*/
	$CheckValueNotAlert->checkLen("客服QQ",$_POST["webQQ"],200);
	$CheckValueNotAlert->checkLen("允许上传文件类型",$_POST["webUpFileType"],200);
	$CheckValueNotAlert->checkReg("允许上传文件大小",$_POST["webUpFileSize"],"/^\d{1,5}$/");
	$CheckValueNotAlert->checkLen("Keywords优化",$_POST["webKeyWords"],500);
	$CheckValueNotAlert->checkLen("Description优化",$_POST["webDescription"],500);
	$webSetting=new WebSetting($_POST["webName"],$_POST["companyName"],$_POST["webAddress"],$_POST["webNumber"],$_POST["webCompanyAddress"],$_POST["webPhone"],$_POST["webFax"],$_POST["webEmail"],$_POST["webEmailPassword"],$_POST["webEmailSmtp"],$_POST["webQQ"],$_POST["webUpFileType"],$_POST["webUpFileSize"],$_POST["webKeyWords"],$_POST["webDescription"],$_POST["examOpen"],$_POST["majorType"],$_POST["examType"]);
	$webSettingData=new WebSettingData();
	$webSettingData->update($webSetting)?done(1,"WebSetting.php"):done(0);
}
?>

<body>
<script type="text/javascript">
function checkForm(obj){
	var checkValueNotAlert=new CheckValueNotAlert();
	if(!checkValueNotAlert.checkLen("网站名称",obj.webName.value,50))return false;
	if(!checkValueNotAlert.checkLen("公司名称",obj.companyName.value,50))return false;
	if(!checkValueNotAlert.checkLen("网站地址",obj.webAddress.value,50))return false;
	if(!checkValueNotAlert.checkLen("备案号",obj.webNumber.value,50))return false;
	if(!checkValueNotAlert.checkLen("公司地址",obj.webCompanyAddress.value,50))return false;
	if(!checkValueNotAlert.checkLen("联系电话",obj.webPhone.value,50))return false;
	if(!checkValueNotAlert.checkLen("传真",obj.webFax.value,50))return false;
	if(!checkValueNotAlert.checkLen("网站邮箱",obj.webEmail.value,50))return false;
	/*if(!checkValueNotAlert.checkLen("网站邮箱密码",obj.webEmailPassword.value,50))return false;
	if(!checkValueNotAlert.checkLen("网站邮箱Smtp",obj.webEmailSmtp.value,50))return false;*/
	if(!checkValueNotAlert.checkLen("客服QQ",obj.webQQ.value,50))return false;
	if(!checkValueNotAlert.checkLen("允许上传文件类型",obj.webUpFileType.value,100))return false;
	if(!checkValueNotAlert.checkReg("允许上传文件大小",obj.webUpFileSize.value,/^[1-9]\d{0,4}$/))return false;
	if(!checkValueNotAlert.checkLen("Keywords优化",obj.webKeyWords.value,250))return false;
	if(!checkValueNotAlert.checkLen("Description优化",obj.webDescription.value,250))return false;
}
</script>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">系统基本设置</div>
	</div>
</div>
<?php
$webSettingData=new WebSettingData();
$webSetting=$webSettingData->getInfo();
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<form action="?act=ok" method="post" name="form1" onsubmit="return checkForm(this);">
	<tr>
		<td width="15%" align="right" class="tdLeft">网站名称：</td>
		<td width="85%" align="left"><input type="text" class="text350" name="webName" value="<?php echo($webSetting->webName);?>"></td>
	</tr>
	<tr>
		<td width="15%" align="right" class="tdLeft">公司名称：</td>
		<td width="85%" align="left"><input type="text" class="text350" name="companyName" value="<?php echo($webSetting->companyName);?>"></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">网站地址：</td>
		<td align="left"><input type="text" class="text" name="webAddress" value="<?php echo($webSetting->webAddress);?>" ></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">备案号：</td>
		<td align="left"><input type="text" class="text" name="webNumber" value="<?php echo($webSetting->webNumber);?>" ></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">公司地址：</td>
		<td align="left"><input type="text" class="text350" name="webCompanyAddress" value="<?php echo($webSetting->webCompanyAddress);?>" ></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">联系电话：</td>
		<td align="left"><input type="text" class="text"  name="webPhone" value="<?php echo($webSetting->webPhone);?>"></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">传真：</td>
		<td align="left"><input type="text" class="text"  name="webFax" value="<?php echo($webSetting->webFax);?>"></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">网站邮箱：</td>
	  	<td align="left"><input type="text" class="text" name="webEmail" value="<?php echo($webSetting->webEmail);?>"></td>
	</tr>
	<!--<tr>
		<td align="right" class="tdLeft">网站邮箱密码：</td>
	  	<td align="left"><input type="password" class="text" name="webEmailPassword" value="<?php echo($webSetting->webEmailPassword);?>"></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">网站邮箱Smtp：</td>
	  	<td align="left"><input type="text" class="text" name="webEmailSmtp" value="<?php echo($webSetting->webEmailSmtp);?>"></td>
	</tr>-->
	<tr>
		<td align="right" class="tdLeft">客服QQ：</td>
	  <td align="left"><input type="text" class="text"  name="webQQ" value="<?php echo($webSetting->webQQ);?>">
	    <font class="zhushi">多个QQ请用‘|’隔开</font></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">允许上传文件类型：</td>
	  <td align="left"><input type="text" class="text"  name="webUpFileType" value="<?php echo($webSetting->webUpFileType);?>">
	    <font class="zhushi">多个文件请用‘|’隔开，如gif|jpg</font></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">允许上传文件大小：</td>
		<td align="left"><input type="text" class="text"  name="webUpFileSize" value="<?php echo($webSetting->webUpFileSize);?>">
		Kb</td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">考试开关：</td>
		<td align="left"><input name="examOpen" type="radio" value="0" checked="checked" />关 <input name="examOpen" type="radio" value="1"<?php if($webSetting->examOpen){echo('checked="checked"');}?>  />开</td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">专业：</td>
		<td align="left"><textarea class="textarea" name="majorType" style="margin-top:10px;"><?php echo($webSetting->majorType);?></textarea><font class="zhushi">多个文件请用‘|’隔开，如111|222</font></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">考试：</td>
		<td align="left"><textarea class="textarea" name="examType" style="margin-top:10px;"><?php echo($webSetting->examType);?></textarea><font class="zhushi">多个文件请用‘|’隔开，如111|222</font></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">Keywords优化：</td>
		<td align="left"><textarea class="textarea" name="webKeyWords" ><?php echo($webSetting->webKeyWords);?></textarea></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">Description优化：</td>
		<td align="left"><textarea class="textarea" name="webDescription" style="margin-top:10px;"><?php echo($webSetting->webDescription);?></textarea></td>
	</tr>	
	<tr>
		<td align="right" class="tdLeft"></td>
		<td align="left"><input type="submit"   value="提交" class="button"></td>
	</tr>
	</form>
</table>
</body>
</html>
