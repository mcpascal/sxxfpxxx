<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/Judge.php");
include(GI."/data/JudgeData.php");
include(GI."/include/CheckValueNotAlert.php");
include(GI."/include/CheckLoginForAdmin.php");
include("BigImg.php");

include(GI."/class/WebSetting.php");
include(GI."/data/WebSettingData.php");
$webSetting=new WebSetting();
$webSettingData=new WebSettingData();
$webSetting=$webSettingData->getInfo();
$classArr = explode("|", $webSetting->majorType);
$classStr = "";
foreach($classArr as $c){
	$classStr .= '<option value="' . $c . '">' . $c . '</option>';
}
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
$act=$_GET["act"];
if($act=="ok"){
	$num = 0;
	$judgeArr;
	for($i = 1; $i <= 10; $i++){
		if($_POST["classname{$i}"] != "" && $_POST["title{$i}"] != "" && ($_POST["answer{$i}"] == "1" || $_POST["answer{$i}"] == "0")){
			$judgeArr[$num] = new Judge($_POST["classname{$i}"], $_POST["title{$i}"],$_POST["answer{$i}"]);
			$num += 1;
		}
	}
	if($num){
		$judgeData = new JudgeData();
		$judgeData->add($judgeArr) ? done(1, "JudgeAdd.php", "共添加条{$num}记录"):done(0);
	}else{
		done(0, "", "", "无效记录");
	}
}
?>
<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">判断题添加</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<form action="?act=ok" method="post" name="form1" onsubmit="return checkForm(this);">
	<tr class="tdTitle">
		<td align="center"><b>编号</b></td>
		<td align="center"><b>类别</b></td>
		<td align="center"><b>题目</b></td>
		<td align="center"><b>结果</b></td>
	</tr>
	<?php
	for($i = 1; $i <= 10; $i++){
	?>
		<tr id="tr<?php echo($i)?>" onMouseOver="javascript:changeTrbk('<?php echo($i);?>');" onMouseOut="javascript:changeTrbk1('<?php echo($i);?>');">
			<td align="center" width="50"><?php echo($i)?></td>
			<td align="center">
				<select class="select" name="classname<?php echo($i)?>"><?php echo $classStr;?></select>
			</td>
			<td align="center"><input type="text" class="text500" name="title<?php echo($i)?>" /></td>
			<td align="center"><input type="radio" name="answer<?php echo($i)?>" value="0" checked="checked" />错&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="answer<?php echo($i)?>" value="1" />对</td>
		</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="4" align="center"><input type="submit"   value="提交" class="button"></td>
	</tr>
	</form>
</table>
</body>
</html>
