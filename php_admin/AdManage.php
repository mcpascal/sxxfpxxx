<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/Ad.php");
include(GI."/data/AdData.php");
include(GI."/class/Page.php");
include(GI."/include/CheckValueNotAlert.php");
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
<script type="text/javascript" src="js/CheckValueNotAlert.js"></script>
<script type="text/javascript" src="js/Admin.js"></script>
</head>

<?php
$id=$_GET["id"];
$act=$_GET["act"];
if($act=="add"){
	$CheckValueNotAlert=new CheckValueNotAlert();
	$CheckValueNotAlert->checkNull("图片",$_POST["image"]);
	$CheckValueNotAlert->checkReg("排序",$_POST["sort1"],"/^\d{1,5}$/");
	$ad=new Ad($_POST["link"],$_POST["image"],$_POST["sort1"]);
	$adData=new AdData();
	$adData->add($ad)?done(1,"AdManage.php"):done(0);
}
if($act=="change"){
	$CheckValueNotAlert=new CheckValueNotAlert();
	$CheckValueNotAlert->checkReg("编号",$id,"/^\d{1,5}$/");
	$CheckValueNotAlert->checkNull("图片",$_POST["image".$id]);
	$CheckValueNotAlert->checkReg("排序",$_POST["sort".$id],"/^\d{1,5}$/");
	$ad=new Ad($_POST["link".$id],$_POST["image".$id],$_POST["sort".$id],$id);
	$adData=new AdData();
	$adData->change($ad)?done(1,"AdManage.php"):done(0);
}
if($act=="del"){
	$CheckValueNotAlert=new CheckValueNotAlert();
	$CheckValueNotAlert->checkReg("编号",$id,"/^\d{1,5}$/");
	$adData=new AdData();
	$adData->delete($id)?done(1,"AdManage.php"):done(0);
}
?>

<script type="text/javascript">
function checkAdd(obj){
	var checkValue=new CheckValueNotAlert();
	if(checkValue.checkNull("图片",obj.image.value))return false;
	if(!checkValue.checkReg("排序",obj.sort1.value,/^\d{1,5}$/))return false;
}
function del(url){
	window.top.win1.win1Show("提示","您确定删除吗？","window.frames[0].frames[4].location.href='"+url+"'",true);
}
function checkFrom(id){
	var checkValue=new CheckValueNotAlert();
	if(checkValue.checkNull("图片",$("image"+id).value))return false;
	if(!checkValue.checkReg("排序",$("sort"+id).value,/^\d{1,5}$/))return false;
}
</script>
<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">广告添加</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr class="tdTitle">
		<td align="center"><b>图片</b></td>
		<td align="center"><b>链接</b></td>
		<td align="center"><b>排序</b></td>
		<td align="center"><b>操作</b></td>
	</tr>
	<form method="post" name="add" action="?act=add" onsubmit="return checkAdd(this)">
	<tr>
		<td align="center">
		<img src="../uploadfile/upfile/null.png" id="img" width="100" height="100" onmouseover="showBigImg(event,'img')" onmouseout="hiddenBigImg()" />
		<input type="button" class="button" value="上传图片" onclick="window.open('../uploadfile/?h=image&img=img','_blank','width=350,height=150,left=500,top=300')">
		<input type="hidden" value="" id="image" name="image" /></td>
		<td align="center"><input type="text" class="text" name="link" value="" /></td>
		<td align="center"><input type="text" class="text60" name="sort1" value="100" /></td>
		<td align="center"><input type="submit" class="button" value="添加" /></td>
	</tr>
	</form>
</table>
<div class="title" style="margin-top:10px;">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">广告管理</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr class="tdTitle">
		<td align="center" width="80"><b>编号</b></td>
		<td align="center"><b>图片</b></td>
		<td align="center"><b>链接</b></td>
		<td align="center"><b>排序</b></td>
		<td align="center"><b>操作</b></td>
	</tr>
	<?php
	$adData=new AdData();
	$arr=$adData->listAll();
	for($i=0;$i<count($arr);$i++){
	?>
		<form method="post" action="?act=change&id=<?php echo($arr[$i]->id);?>" onsubmit="return checkFrom('<?php echo($arr[$i]->id);?>')">
		<tr id="tr<?php echo($i+1)?>" onMouseOver="javascript:changeTrbk('<?php echo($i+1);?>');" onMouseOut="javascript:changeTrbk1('<?php echo($i+1);?>');">
			<td align="center"><?php echo($arr[$i]->id);?></td>
			<td align="center">
			<img src="../uploadfile/upfile/<?php echo($arr[$i]->image)?>" id="img<?php echo($arr[$i]->id);?>" width="100" height="100" onmouseover="showBigImg(event,'img<?php echo($arr[$i]->id);?>')" onmouseout="hiddenBigImg()" />
			<input type="button" class="button" value="上传图片" onclick="window.open('../uploadfile/?h=image<?php echo($arr[$i]->id);?>&img=img<?php echo($arr[$i]->id);?>','_blank','width=350,height=150,left=500,top=300')">
			<input type="hidden" value="<?php echo($arr[$i]->image)?>" id="image<?php echo($arr[$i]->id);?>" name="image<?php echo($arr[$i]->id);?>" /></td>
			<td align="center">
			<input type="text" class="text" value="<?php echo($arr[$i]->link);?>" id="link<?php echo($arr[$i]->id);?>" name="link<?php echo($arr[$i]->id);?>" />
			</td>
			<td align="center"><input type="text" class="text60" value="<?php echo($arr[$i]->sort);?>" id="sort<?php echo($arr[$i]->id);?>" name="sort<?php echo($arr[$i]->id);?>" />
			</td>
			<td align="center">
				<input type="submit" class="button" value="修改" />
				<span style="cursor:pointer" onclick="del('AdManage.php?act=del&id=<?php echo($arr[$i]->id);?>');">删除</span>
			</td>
		</tr>
		</form>
	<?php
	}
	?>
</table>

</div>
</body>
</html>
