﻿<?php
function GetProductOptionTree($UpClassId,$Grade,$Num)//上级ID,树级，缩进量
{
	if($UpClassId==0){
		$sql="select * from tbl_productclass where upclassid=0 order by sort asc , id asc";
	}else{
		$sql="select * from tbl_productclass where upclassid=".(int)$UpClassId." order by sort asc , id asc";
	}
	$result=mysql_query($sql);
	while($arr=mysql_fetch_array($result)){
		echo("<option value='".$arr["id"]."'>");
		for($i=1;$i<=$Grade;$i++){
			for($j=1;$j<=$Num;$j++){
				echo("&nbsp;");
			}
		}
		echo($arr["classname"]."</option>");
		GetProductOptionTree($arr["id"],$Grade+1,$Num);
	}
}

function GetProductOptionTreeAndSelect($UpClassId,$Grade,$Num,$SelectedId)//上级ID,树级，缩进量
{
	if($UpClassId==0){
		$sql="select * from tbl_productclass where upclassid=0 order by sort asc , id asc";
	}else{
		$sql="select * from tbl_productclass where upclassid=".(int)$UpClassId." order by sort asc , id asc";
	}
	$result=mysql_query($sql);
	while($arr=mysql_fetch_array($result)){
		echo("<option value='".$arr["id"]."'");
		if($arr["id"]==(int)$SelectedId){
			echo(" selected='selected'");
		}
		echo("'>");
		for($i=1;$i<=$Grade;$i++){
			for($j=1;$j<=$Num;$j++){
				echo("&nbsp;");
			}
		}
		echo($arr["classname"]."</option>");
		GetProductOptionTreeAndSelect($arr["id"],$Grade+1,$Num,$SelectedId);
	}
}


function GetProductTrTree($UpClassId,$Grade,$Num)//上级ID,树级，缩进量
{
	if($UpClassId==0){
		$sql="select * from tbl_productclass where upclassid=0 order by sort asc , id asc";
	}else{
		$sql="select * from tbl_productclass where upclassid=".(int)$UpClassId." order by sort asc , id asc";
	}
	$result=mysql_query($sql);
	while($arr=mysql_fetch_array($result)){
		echo("<form method='post' action='?act=change&id=".$arr["id"]."' onsubmit=\"return check_from('".$arr["id"]."')\">");
		echo("<tr id='tr_".$arr["id"]."' onMouseOver='javascript:change_trbk(".$arr["id"].")' onMouseOut='javascript:change_trbk1(".$arr["id"].")'>");
		echo("<td align='center'>".$arr["id"]."</td>");
		echo("<td align='left' style='padding-left:".$Grade*$Num."px;'><input type='text' class='text' value='".$arr["classname"]."' id='name_".$arr["id"]."' name='name_".$arr["id"]."' /></td>");
		echo("<td align='center'><input type='text' class='text60' value='".$arr["sort"]."' id='sort_".$arr["id"]."' name='sort_".$arr["id"]."' /></td>");
		echo("<td align='center'><input type='submit' class='button' value='修改' /><a style='margin-left:50px;' href='?act=del&id=".$arr["id"]."' onclick=\"return confirm('删除该类别将删除该类的下级类别以及类别下的所有产品，您确定删除吗？')\">删除</a></td>");
		echo("</tr>");
		echo("</form>");
		GetProductTrTree($arr["id"],$Grade+1,$Num);
	}
}

$productClassIdStr="";
function GetProductIdStr($UpClassId)//上级ID
{
	global $productClassIdStr;
	if($UpClassId==0){
		$productClassIdStr="0";
		return;
	}else{
		$sql="select * from tbl_productclass where upclassid=".(int)$UpClassId." order by sort asc , id asc";
	}
	$result=mysql_query($sql);
	while($arr=mysql_fetch_array($result)){
		if($productClassIdStr==""){
			$productClassIdStr=(string)$arr["id"];
		}else{
			$productClassIdStr.=",".(string)$arr["id"];
		}
		GetProductIdStr($arr["id"]);
	}
}
?>