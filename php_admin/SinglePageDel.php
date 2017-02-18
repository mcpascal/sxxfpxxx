<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/SinglePage.php");
include(GI."/data/SinglePageData.php");
include(GI."/include/CheckLoginForAdminAjax.php");
?>
<?php
$id=$_POST["id"];
if(!preg_match("/^[0-9,]{1,}$/",$id)){
	echo(0);
	die();
}
$singlePageData=new SinglePageData();
$singlePageData->delete($id)?print("1"):print("0");
?>