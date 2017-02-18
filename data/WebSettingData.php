<?php
class WebSettingData{
	function update($webSetting){
		$returnValue=false;
		$sql="select * from tbl_webSetting";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)==0){
			$sql="insert into tbl_webSetting(webName,companyName,webAddress,webNumber,webCompanyAddress,webPhone,webFax,webEmail,webEmailPassword,webEmailSmtp,webQQ,webUpFileType,webUpFileSize,webKeyWords,webDescription,examOpen,majorType,examType) values('".$webSetting->webName."','".$webSetting->companyName."','".$webSetting->webAddress."','".$webSetting->webNumber."','".$webSetting->webCompanyAddress."','".$webSetting->webPhone."','".$webSetting->webFax."','".$webSetting->webEmail."','".$webSetting->webEmailPassword."','".$webSetting->webEmailSmtp."','".$webSetting->webQQ."','".$webSetting->webUpFileType."',".$webSetting->webUpFileSize.",'".$webSetting->webKeyWords."','".$webSetting->webDescription."',".$webSetting->examOpen.",'".$webSetting->majorType."','".$webSetting->examType."')";
			mysql_query($sql)?$returnValue=true:$returnValue=false;
		}else{
			$sql="update tbl_webSetting set webName='".$webSetting->webName."',companyName='".$webSetting->companyName."',webAddress='".$webSetting->webAddress."',webNumber='".$webSetting->webNumber."',webCompanyAddress='".$webSetting->webCompanyAddress."',webPhone='".$webSetting->webPhone."',webFax='".$webSetting->webFax."',webEmail='".$webSetting->webEmail."',webEmailPassword='".$webSetting->webEmailPassword."',webEmailSmtp='".$webSetting->webEmailSmtp."',webQQ='".$webSetting->webQQ."',webUpFileType='".$webSetting->webUpFileType."',webUpFileSize=".$webSetting->webUpFileSize.",webKeyWords='".$webSetting->webKeyWords."',webDescription='".$webSetting->webDescription."',examOpen=".$webSetting->examOpen.",majorType='".$webSetting->majorType."',examType='".$webSetting->examType."'";
			mysql_query($sql)?$returnValue=true:$returnValue=false;
		}
		return $returnValue;
	}
	function getInfo(){
		$webSetting=new WebSetting();
		$sql="select * from tbl_webSetting order by id asc limit 1";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)>0){
			$arr=mysql_fetch_array($result);
			$webSetting=new WebSetting($arr["webName"],$arr["companyName"],$arr["webAddress"],$arr["webNumber"],$arr["webCompanyAddress"],$arr["webPhone"],$arr["webFax"],$arr["webEmail"],$arr["webEmailPassword"],$arr["webEmailSmtp"],$arr["webQQ"],$arr["webUpFileType"],$arr["webUpFileSize"],$arr["webKeyWords"],$arr["webDescription"],$arr["examOpen"],$arr["majorType"],$arr["examType"]);
		}
		return $webSetting;
	}
}
?>