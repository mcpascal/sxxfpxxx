<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/Select.php");
include(GI."/data/SelectData.php");
include(GI."/include/CheckValueNotAlert.php");
include(GI."/include/CheckLoginForAdmin.php");
?>
<?php
$id=$_POST["id"];
if(!preg_match("/^[0-9,]{1,}$/",$id)){
	echo(0);
	die();
}
$judgeData=new SelectData();
$judgeData->delete($id)?print("1"):print("0");
?>