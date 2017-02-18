<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/SinglePageClass.php");
include(GI."/data/SinglePageClassData.php");
include(GI."/class/SinglePage.php");
include(GI."/data/SinglePageData.php");
include(GI."/include/CheckValueNotAlert.php");
include(GI."/include/CheckLoginForAdmin.php");
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
	$checkValueNotAlert=new CheckValueNotAlert();
	$checkValueNotAlert->checkNull("类别名称",$_POST["name"]);
	$checkValueNotAlert->checkReg("本类排序",$_POST["sort1"],"/^\d{1,}$/");
	$singlePageClass=new SinglePageClass($_POST["name"],0,0,"",1,$_POST["sort1"]);
	$singlePageClassData=new SinglePageClassData();
	if(is_numeric($_POST["upClassId"])){
		$singlePageClassData->addByUpClassId($_POST["upClassId"],$singlePageClass)?done(1,"SinglePageClassManage.php"):done(0);
	}else{
		$singlePageClassData->add($singlePageClass)?done(1,"SinglePageClassManage.php"):done(0);
	}
}
if($act=="change"){
	$checkValueNotAlert=new CheckValueNotAlert();
	$checkValueNotAlert->checkReg("编号",$id,"/^\d{1,}$/");
	$checkValueNotAlert->checkNull("类别名称",$_POST["name".$id]);
	$checkValueNotAlert->checkReg("本类排序",$_POST["sort".$id],"/^\d{1,}$/");
	$singlePageClass=new SinglePageClass($_POST["name".$id],0,0,"",0,$_POST["sort".$id],(int)$id);
	$singlePageClassData=new SinglePageClassData();
	$singlePageClassData->change($singlePageClass)?done(1,"SinglePageClassManage.php"):done(0);
}

if($act=="del"){
	$checkValueNotAlert=new CheckValueNotAlert();
	$checkValueNotAlert->checkReg("编号",$id,"/^\d{1,}$/");
	$singlePageClassData=new SinglePageClassData();
	if($singlePageClassData->delete($id)){
		$singlePageData=new SinglePageData();
		$singlePageData->deleteBySinglePageClassId($singlePageClassData->idStr)?done(1,"SinglePageClassManage.php"):done(0);
	}else{
		done(0);
	}
}
?>

<script type="text/javascript">
function checkAdd(obj){
	var checkValueNotAlert=new CheckValueNotAlert();
	if(checkValueNotAlert.checkNull("类别名称",obj.name.value))return false;
	if(!checkValueNotAlert.checkReg("本类排序",obj.sort1.value,/^\d{1,}$/))return false;
}
function checkChange(id){
	var checkValueNotAlert=new CheckValueNotAlert();
	if(checkValueNotAlert.checkNull("类别名称",$("name"+id).value))return false;
	if(!checkValueNotAlert.checkReg("本类排序",$("sort"+id).value,/^\d{1,}$/))return false;
}
function del(url){
	window.top.win1.win1Show("提示","删除该类别将一并删除下级类别及类别对应内容，<br />您确定删除吗？","window.frames[0].frames[4].location.href='"+url+"'",true);
}
</script>
<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">单页面类别添加</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr class="tdTitle">
		<td align="center"><b>上级类别名称（可为空）</b></td>
		<td align="center"><b>类别名称</b></td>
		<td align="center"><b>本类排序</b></td>
		<td align="center"><b>操作</b></td>
	</tr>
	<form method="post" name="add" action="?act=add" onsubmit="return checkAdd(this)">
	<tr>
		<td align="center">
		<select name="upClassId">
			<option value=""></option>
			<?php
			$singlePageClassData=new SinglePageClassData();
			$singlePageClassData->listAll(0);
			for($i=0;$i<count($singlePageClassData->arrAll);$i++){
			?>
				<option value="<?php echo($singlePageClassData->arrAll[$i]->id);?>">
				<?php
				for($j=1;$j<($singlePageClassData->arrAll[$i]->grade-1)*5;$j++){echo("&nbsp;");}
				?>
				<?php echo($singlePageClassData->arrAll[$i]->name);?></option>
			<?php
			}
			?>
		</select>
		</td>
		<td align="center"><input type="text" class="text" name="name" /></td>
		<td align="center"><input type="text" class="text60" name="sort1" value="50" /></td>
		<td align="center"><input type="submit" class="button" value="添加" /></td>
	</tr>
	</form>
</table>
<div class="title" style="margin-top:10px;">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">单页面类别管理</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr class="tdTitle">
		<td align="center" width="80"><b>编号</b></td>
		<td align="center"><b>类别名称</b></td>
		<td align="center"><b>本类排序</b></td>
		<td align="center"><b>操作</b></td>
	</tr>
	<?php
	$singlePageClassData=new SinglePageClassData();
	$singlePageClassData->listAll(0);
	$arr=$singlePageClassData->arrAll;
	for($i=0;$i<count($arr);$i++){
	?>
		<form method="post" action="?act=change&id=<?php echo($arr[$i]->id);?>" onsubmit="return checkChange('<?php echo($arr[$i]->id);?>')">
		<tr id="tr<?php echo($i+1)?>" onMouseOver="javascript:changeTrbk('<?php echo($i+1);?>');" onMouseOut="javascript:changeTrbk1('<?php echo($i+1);?>');">
			<td align="center"><?php echo($arr[$i]->id);?></td>
			<td align="left" style=" padding-left:<?php echo($arr[$i]->grade*20-20);?>px;"><input type="text" class="text" value="<?php echo($arr[$i]->name);?>" id="name<?php echo($arr[$i]->id);?>" name="name<?php echo($arr[$i]->id);?>" />
			<td align="center"><input type="text" class="text60" value="<?php echo($arr[$i]->sort);?>" id="sort<?php echo($arr[$i]->id);?>" name="sort<?php echo($arr[$i]->id);?>" />
			</td>
			<td align="center">
				<input type="submit" class="button" value="修改" />
				<span style="cursor:pointer" onclick="del('SinglePageClassManage.php?act=del&id=<?php echo($arr[$i]->id);?>');">删除</span>
			</td>
		</tr>
		</form>
	<?php
	}
	?>
	
</table>
</body>
</html>
