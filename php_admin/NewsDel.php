<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/News.php");
include(GI."/data/NewsData.php");
include(GI."/include/CheckLoginForAdminAjax.php");
?>
<?php
$id=$_POST["id"];
if(!preg_match("/^[0-9,]{1,}$/",$id)){
	echo(0);
	die();
}
$newsData=new NewsData();
$newsData->delete($id)?print("1"):print("0");
?>