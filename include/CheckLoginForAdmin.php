<?php
if(@$_SESSION["adminUserName"] == ""){
	alertAndTopGo("请登陆","Login.php");
}
?>