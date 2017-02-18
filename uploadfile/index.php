<?php
include("../config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/css.css" rel="stylesheet" type="text/css" />
</head>

<?php
$allowFileType="png|gif|jpg";
$allowFileSize=2;
$filePath="upfile/";
$sql="select * from tbl_webSetting";
$result=mysql_query($sql);
if(mysql_num_rows($result)>0){
	$row=mysql_fetch_array($result);
	if($row["webUpFileType"]!=""){
		$allowFileType=$row["webUpFileType"];
	}
	if(is_numeric($row["webUpFileSize"])){
		$allowFileSize=(int)$row["webUpFileSize"];
	}
}
$act=$_GET["act"];
$hiddenFildId=$_GET["h"];
$imgId=$_GET["img"];
if($act=="ok"){
	if($_POST["file1"]==""&&$_FILES["file1"]["name"]==""){
		alert11("请选择上传文件","index.php");
	}
	$arr=explode(".",$_FILES["file1"]["name"]);
	if(strpos("_".$allowFileType,$arr[count($arr)-1])==false){
		alertAndGo("文件类型错误","index.php");
	}
	if($_FILES["file1"]["size"]/1024>$allowFileSize){
		alertAndGo("文件过大","index.php");
	}
	$newFileName1=(string)date("Y").(string)date("m").(string)date("d").(string)rand(1000,9999).".".$arr[count($arr)-1];
	$newFileName=$filePath.$newFileName1;
	if(move_uploaded_file($_FILES["file1"]["tmp_name"],$newFileName)){
		echo("上传成功");
		if($hiddenFildId!=""){
			echo("<script type=\"text/javascript\">window.opener.document.getElementById('".$hiddenFildId."').value='".$newFileName1."';</script>");
		}
		if($imgId!=""){
			echo("<script type=\"text/javascript\">window.opener.document.getElementById('".$imgId."').src='../uploadfile/".$newFileName."';;</script>");
		}
		exit();
	}else{
		alertAndBack("上传失败：".$_FILES["file1"]["error"]);
	}
}
?>
<body>

<script type="text/javascript">
function check_form(){
	if(document.form1.file1.value==""){
		alert("请选择文件");
		return false;
	}	
}

</script>
<div style="width:100%;" align="center">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<form action="?act=ok&h=<?php echo($hiddenFildId);?>&img=<?php echo($imgId);?>" method="post" enctype="multipart/form-data" name="form1" onsubmit="return check_form();">
	<tr>
		<td width="30%" align="center" class="td_left">
		<input type="file" name="file1" />
		<input type="submit"   value="提交" class="button">
		</td>
	</tr>
	<tr>
		<td style="color:#FF0000; font-size:12px; line-height:20px;" align="center">
		允许上传的文件类型为：<?php echo ($allowFileType)?>,<br />且大小不得超过<?php echo($allowFileSize)?>Kb。
		</td>
	</tr>
	</form>
</table>
</div>
</body>
</html>
