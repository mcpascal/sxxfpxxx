<?php
include("../config.php");
include("../Base.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/User.php");
include(GI."/data/UserData.php");
include(GI."/class/Score.php");
include(GI."/data/ScoreData.php");
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
String.prototype.trim=function() {
    return this.replace(/(^\s*)|(\s*$)/g,'');
}
function checkAdd(obj){
	var checkValue=new CheckValueNotAlert();
	if(!checkValue.checkReg("身份证号",obj.userName.value,/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/))return false;
	if(!checkValue.checkReg("成绩",obj.newScore.value.trim(),/^(0|[1-9]\d|100)$/))return false;
}
</script>
</head>
<?php
$act=$_GET["act"];
if($act=="add"){
	$CheckValueNotAlert=new CheckValueNotAlert();
	$CheckValueNotAlert->checkReg("身份证号",$_POST["card"],"/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/");
	$CheckValueNotAlert->checkReg("成绩",intval($_POST["newScore"]),"/^(0|[1-9]\d|100)$/");
	$scoreData=new ScoreData();
	$messageData=new UserData();
	$a = $messageData->getInfoByUserNameOrCard($_POST["card"]);
	$user = $a[1];	
	//print_r($user);
	$classname=$_POST["examType"];
	//echo $classname;die();
	$username=$user->username;
	//echo $username;
	$newScore=$_POST["newScore"];
	//echo $newScore;
	$addtime=date("Y-m-d H:i",time());
	//echo $addtime;
	$id=$user->id;
	//echo $id;
	$score=new Score($classname, $username, $newScore, $addtime, $id);
	//print_r($score);
	//echo "hello";
	$scoreData->add($score)?done(1,"ScoreManage.php"):done(0);
}
?>
<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">成绩录入</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<form action="?act=add" method="post" name="form1" onsubmit="return checkAdd(this);">
	<tr>
		<td width="15%" align="right" >身份证号：</td>
		<td align="left"><input type="text" class="text" value="" name="card"><span class="red">15或18位数字</span></td>
	</tr>
	<tr>
		<td align="right" >成绩：</td>
		<td align="left"><input type="text" class="text" value=""  name="newScore"><span class="red">0-100之间数字</span></td>
	</tr>
	<tr>
							<td align="right">考试类别：</td>
							<td align="left">
							  <select name="examType">
							  <option value="">请选择</option>
							  <?php
							  $examArr = explode("|",$webSetting->examType);
							  foreach($examArr as $exam){
							  ?>
							    
							    <option value="<?php echo($exam);?>"><?php echo($exam);?></option>
							  <?php
							  }
							  ?>
						            </select>
							  <span class="zi">*</span></td>
						  </tr>
	<tr>
		<td></td>
		<td align="left"><input type="submit"   value="提交" class="button"></td>
	</tr>
	</form>
</table>
</body>
</html>
