<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/AdminUserLoginLog.php");
include(GI."/data/AdminUserLoginLogData.php");
include(GI."/include/CheckLoginForAdminAjax.php");
?>
<?php
$id=$_POST["id"];
if(!preg_match("/^[0-9,]{1,}$/",$id)){
	echo(0);
	die();
}
$adminUserLoginLogData=new AdminUserLoginLogData();
$adminUserLoginLogData->delete($id)?print("1"):print("0");
?>