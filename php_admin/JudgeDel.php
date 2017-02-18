<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/Judge.php");
include(GI."/data/JudgeData.php");
include(GI."/include/CheckValueNotAlert.php");
include(GI."/include/CheckLoginForAdmin.php");
?>
<?php
$id=$_POST["id"];
if(!preg_match("/^[0-9,]{1,}$/",$id)){
	echo(0);
	die();
}
$judgeData=new JudgeData();
$judgeData->delete($id)?print("1"):print("0");
?>