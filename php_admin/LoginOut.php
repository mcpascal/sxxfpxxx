<?php
session_start();
include("../include/Function.php");
unset($_SESSION["adminUserName"]);
unset($_SESSION["adminPower"]);
unset($_SESSION["adminId"]);
unset($_SESSION["adminPassword"]);
gotoTop("Login.php");
?>
