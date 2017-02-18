<?php
include("class/WebSetting.php");
include("data/WebSettingData.php");
$webSetting=new WebSetting();
$webSettingData=new WebSettingData();
$webSetting=$webSettingData->getInfo($conn);
?>