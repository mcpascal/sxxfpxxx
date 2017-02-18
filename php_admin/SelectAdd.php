<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/Select.php");
include(GI."/data/SelectData.php");
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

<script type="text/javascript">
function checkForm(obj){
	var checkValue=new CheckValueNotAlert();
	if(checkValue.checkNull("题目",obj.title.value))return false;
	if(checkValue.checkNull("选项A",obj.a.value))return false;
	if(checkValue.checkNull("选项B",obj.b.value))return false;
	if(checkValue.checkNull("选项C",obj.c.value))return false;
	if(checkValue.checkNull("选项D",obj.d.value))return false;
	var arr = document.getElementsByName("type");
	var type = "1";
	for(var i = 0; i < arr.length; i++){
		if(arr[i].checked == true){
			type = arr[i].value;
		}
	}
	var arr = document.getElementsByName("answer[]");
	var answer = "";
	
	for(var i = 0; i < arr.length; i++){
		if(arr[i].checked == true){
			answer += arr[i].value;
		}
	}
	if(answer == ""){
		checkValue.msg("请勾选答案");
		return false;
	}
	if(type == "1" && answer.length>1){
		checkValue.msg("单选题答案必须唯一");
		return false;
	}
}
</script>
</head>
<?php
$act=$_GET["act"];
if($act=="ok"){
	$CheckValueNotAlert=new CheckValueNotAlert();
	if($_POST["type"] != "1" && $_POST["type"] != "2"){
		$CheckValueNotAlert->message("类别错误");
	}
	$CheckValueNotAlert->checkNull("题目",$_POST["title"]);
	$CheckValueNotAlert->checkNull("选项A",$_POST["a"]);
	$CheckValueNotAlert->checkNull("选项B",$_POST["b"]);
	$CheckValueNotAlert->checkNull("选项C",$_POST["c"]);
	$CheckValueNotAlert->checkNull("选项D",$_POST["d"]);
	$answerArr = $_POST["answer"];
	$answer = "";
	foreach($answerArr as $k => $v){
		$answer .= $v;
	}
	$CheckValueNotAlert->checkNull("答案",$answer);
	if($_POST["type"] == 1 && strlen($answer) > 1){
		$CheckValueNotAlert->message("单选答案必须唯一");
	}
	$select=new Select($_POST["classname"],$_POST["type"],$_POST["title"],$_POST["a"],$_POST["b"],$_POST["c"],$_POST["d"],$answer);
	$selectData=new SelectData();
	$selectData->add($select)?done(1,"SelectAdd.php"):done(0);
}
?>
<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">选择题添加</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<form action="?act=ok" method="post" name="form1" onsubmit="return checkForm(this);">
	<tr>
		<td align="right" class="tdLeft">类别：<span class="red">*</span></td>
		<td align="left">
		<select class="select" name="classname"><?php echo $classStr;?></select>
		</td>
	</tr>
	<tr>
		<td width="15%" align="right" class="tdLeft">类型：<span class="red">*</span></td>
		<td align="left">
		<input type="radio" name="type" value="1" checked="checked" />单选&nbsp;&nbsp;&nbsp;<input name="type" type="radio" value="2" />多选
		</td>
	</tr>
	
	<tr>
		<td align="right" class="tdLeft">题目：<span class="red">*</span></td>
		<td align="left"><input type="text" class="text500" value="" name="title"></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">选项A：<span class="red">*</span></td>
		<td align="left">
			<input type="text" class="text500" value="" name="a">
		</td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">选项B：<span class="red">*</span></td>
		<td align="left">
			<input type="text" class="text500" value="" name="b">
		</td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">选项C：<span class="red">*</span></td>
		<td align="left">
			<input type="text" class="text500" value="" name="c">
		</td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">选项D：<span class="red">*</span></td>
		<td align="left">
			<input type="text" class="text500" value="" name="d">
		</td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">答案：<span class="red">*</span></td>
		<td align="left">
			<input type="checkbox" value="a" name="answer[]" />A
			<input type="checkbox" value="b" name="answer[]" />B
			<input type="checkbox" value="c" name="answer[]" />C
			<input type="checkbox" value="d" name="answer[]" />D
		</td>
	</tr>
	<tr>
		<td></td>
		<td align="left"><input type="submit"   value="提交" class="button"></td>
	</tr>
	</form>
</table>
</body>
</html>
