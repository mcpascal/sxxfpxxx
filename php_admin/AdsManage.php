<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/include/conn.php");
include(GI."/class/TestValue.php");
include(GI."/include/CheckLoginForAdmin.php");
include("BigImg.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/Right.js"></script>
<script type="text/javascript" src="js/js.js"></script>
<script type="text/javascript" src="js/Admin.js"></script>
</head>

<?php
$id=$_GET["id"];
$act=$_GET["act"];
if($act=="add"){
	$testval=new TestValue;
	$testval->TestNull("图片",$_POST["hfile"]);
	$testval->TestReg("排序",$_POST["sort1"],"/^\d{1,5}$/");
	$sql="insert into tbl_ads(FileName,classname,sort) values('".$_POST["hfile"]."','".$_POST["classname"]."',".(int)$_POST["sort1"].")";
	if(!mysql_query($sql)){
		alert1("操作失败");	
	}else{
		alert11("操作成功","AdsManage.php");
	}
}
if($act=="ok"){
	if(!is_numeric($id)){
		alert1("非法操作");
	}
	$id=(int)$id;
	$sql="select * from tbl_ads where id=".$id;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)==0){
		alert1("该记录不存在");
	}
	$testval=new TestValue;
	$testval->TestNull("图片",$_POST["hfile_".(string)$id]);
	$testval->TestReg("排序",$_POST["sort_".(string)$id],"/^\d{1,5}$/");
	$sql="update tbl_ads set FileName='".$_POST["hfile_".(string)$id]."',sort=".(int)$_POST["sort_".(string)$id]." where ID=".$id;
	if(!mysql_query($sql)){
		alert1("操作失败");	
	}else{
		alert11("操作成功","AdsManage.php");
	}
}
if($act=="del"){
	if(!is_numeric($id)){
		alert1("非法操作");
	}
	$id=(int)$id;
	$sql="select * from tbl_ads where id=".$id;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)==0){
		alert1("该记录不存在");
	}
	$sql="delete from tbl_ads where ID=".$id;
	if(!mysql_query($sql)){
		alert1("操作失败");	
	}else{
		alert11("操作成功","AdsManage.php");
	}
}
?>

<script type="text/javascript">
function check_from(id){
	if($("hfile_"+id).value==""){
		alert("请上传图片");
		return false;
	}
	if($("sort_"+id).value.match(/^\d{1,5}$/)==null){
		alert("排序非法");
		return false;
	}
}
function check_add(){
	if($("hfile").value==""){
		alert("请上传图片");
		return false;
	}
	if($("sort1").value.match(/^\d{1,5}$/)==null){
		alert("排序非法");
		return false;
	}
}
</script>
<body>
<div style="width:100%;" align="center">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<caption>
	<strong>广告位添加</strong>
	</caption>
	<tr>
		<td align="center"><b>类别</b></td>
		<td align="center"><b>图片</b></td>
		<td align="center"><b>排序</b></td>
		<td align="center"><b>操作</b></td>
	</tr>
	<form method="post" name="add" action="?act=add" onsubmit="return check_add()">
	<tr>
		<td align="center"><select name="classname"><option value="焦点图">焦点图</option></select></td>
		<td align="center">
		<img src="../uploadfile/upfile/null.png" id="img" width="100" height="100" onmouseover="showBigImg(event,'img')" onmouseout="hiddenBigImg()" />
		<input type="hidden" name="hfile" id="hfile" value="" />
		<input type="button" value="上传" class="button" onclick="window.open('../uploadfile/?h=hfile&img=img','_blank','width=350,height=150,left=500,top=300')" />
		</td>
		<td align="center"><input type="text" class="text60" id="sort1" name="sort1" value="20" /></td>
		<td align="center"><input type="submit" class="button" value="添加" /></td>
	</tr>
	</form>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<caption>
	<strong>广告位管理</strong>
	</caption>
	<tr>
		<td align="center"><b>编号</b></td>
		<td align="center"><b>类别</b></td>
		<td align="center"><b>图片</b></td>
		<td align="center"><b>排序</b></td>
		<td align="center"><b>操作</b></td>
	</tr>
	<?php
	$sql="select * from tbl_ads order by id asc";
	$result=mysql_query($sql);
	$i=1;
	while($arr=mysql_fetch_array($result)){
	?>
		<form method="post" action="?act=ok&id=<?php echo($arr["ID"]);?>" onsubmit="return check_from('<?php echo($arr["ID"]);?>')">
		<tr id="tr_<?php echo($i)?>" onMouseOver="javascript:change_trbk('<?php echo($i);?>');" onMouseOut="javascript:change_trbk1('<?php echo($i);?>');">
			<td align="center"><?php echo($arr["ID"]);?></td>
			<td align="center"><?php echo($arr["classname"]);?></td>
			<td align="center">
			<?php 
				if($arr["FileName"]!=""){
			?>
					<img id="img_<?php echo($arr["ID"]);?>" src="../uploadfile/upfile/<?php echo($arr["FileName"]);?>" width="100" height="100" onmouseover="show_big_img(event,'img_<?php echo($arr["ID"]);?>')" onmouseout="hidden_big_img()" />
			<?php 
				}else{
			?>
					<img id="img_<?php echo($arr["ID"]);?>" src="../uploadfile/upfile/null.png" width="100" height="100" onmouseover="showBigImg(event,'img_<?php echo($arr["ID"]);?>')" onmouseout="hiddenBigImg()" />
			<?php
				}
			?>
				<input type="hidden" name="hfile_<?php echo($arr["ID"]);?>" id="hfile_<?php echo($arr["ID"]);?>" value="<?php echo($arr["FileName"]);?>" />
				<input type="button" value="上传" class="button" onclick="window.open('../uploadfile/?h=hfile_<?php echo($arr["ID"]);?>&img=img_<?php echo($arr["ID"]);?>','_blank','width=350,height=150,left=500,top=300')" />
			</td>
			<td align="center">
				<input type="text" class="text60" name="sort_<?php echo($arr["ID"]);?>" id="sort_<?php echo($arr["ID"]);?>" value="<?php echo($arr["sort"]);?>" />
			</td>
			<td align="center"><input type="submit" class="button" value="修改" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=del&id=<?php echo($arr["ID"]);?>">删除</a></td>
		</tr>
		</form>
	<?php
		$i+=1;
	}
	?>
</table>
</div>
</body>
</html>
