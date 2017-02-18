<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/Product.php");
include(GI."/data/ProductData.php");
include(GI."/class/ProductClass.php");
include(GI."/data/ProductClassData.php");
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
<link rel="stylesheet" href="../kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="../kindeditor/plugins/code/prettify.css" />
<script type="text/javascript" src="js/CheckValueNotAlert.js"></script>
<script type="text/javascript" src="js/Admin.js"></script>
<script type="text/javascript" src="js/Date.js"></script>
<script charset="utf-8" src="../kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="../kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="../kindeditor/plugins/code/prettify.js"></script>
<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			cssPath : '../kindeditor/plugins/code/prettify.css',
			uploadJson : '../kindeditor/php/upload_json.php',
			fileManagerJson : '../kindeditor/php/file_manager_json.php',
			allowFileManager : true
		});
		K('input[name=getHtml]').click(function(e) {
		});
	});
</script>
<script type="text/javascript">
function checkForm(obj){
	var checkValue=new CheckValueNotAlert();
	if(!checkValue.checkReg("类别",obj.productClassId.value,/^\d{1,}$/))return false;
	if(checkValue.checkNull("标题",obj.title.value))return false;
	if(checkValue.checkNull("图片",obj.image.value))return false;
	if(!checkValue.checkReg("首页排序",obj.indexSort.value,/^\d{1,5}$/))return false;
	if(!checkValue.checkReg("本类排序",obj.classSort.value,/^\d{1,5}$/))return false;
	obj.content.value=editor.html();
}
</script>
</head>
<?php
$id=$_GET["id"];
if(!is_numeric($id)){
	done(0);
}
$id=(int)$id;
$act=$_GET["act"];
if($act=="ok"){
	$CheckValueNotAlert=new CheckValueNotAlert();
	$CheckValueNotAlert->checkReg("类别",$_POST["productClassId"],"/^\d{1,5}$/");
	$CheckValueNotAlert->checkNull("标题",$_POST["title"]);
	$CheckValueNotAlert->checkNull("图片",$_POST["image"]);
	$CheckValueNotAlert->checkReg("首页排序",$_POST["indexSort"],"/^\d{1,5}$/");
	$CheckValueNotAlert->checkReg("本类排序",$_POST["classSort"],"/^\d{1,5}$/");
	$CheckValueNotAlert->checkReg("添加时间",$_POST["addTime"],"/^\d{4}-\d{2}-\d{2}$/");
	$product=new Product($_POST["productClassId"],$_POST["title"],$_POST["image"],$_POST["content"],$_POST["indexSort"],$_POST["classSort"],$_POST["addTime"],$id);
	$productData=new ProductData();
	$productData->change($product)?done(1,"ProductManage.php"):done(0);
}
$productData=new ProductData();
$arr=$productData->getInfoById($id);
if(!$arr[0]){
	done(0);
}
?>

<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">产品修改</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<form action="?act=ok&id=<?php echo($id)?>" method="post" name="form1" onsubmit="return checkForm(this);">
	<tr>
		<td width="15%" align="right" class="tdLeft">类别：<span class="red">*</span></td>
		<td align="left">
		<select name="productClassId" class="select">
			<?php
			$productClassData=new ProductClassData();
			$productClassData->listAll(0);
			for($i=0;$i<count($productClassData->arrAll);$i++){
			?>
				<option value="<?php echo($productClassData->arrAll[$i]->id);?>"<?php if($arr[1]->productClassId==$productClassData->arrAll[$i]->id){echo(" selected=\"selected\"");}?>>
				<?php
				for($j=1;$j<($productClassData->arrAll[$i]->grade-1)*5;$j++){echo("&nbsp;");}
				?>
				<?php echo($productClassData->arrAll[$i]->name);?></option>
			<?php
			}
			?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">标题：<span class="red">*</span></td>
		<td align="left"><input type="text" class="text" value="<?php echo($arr[1]->title)?>" name="title"></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">效果图：</td>
		<td align="left" class="padding5">
		<?php 
		$image="null.png";
		if($arr[1]->image!=""){
			$image=$arr[1]->image;
		}
		?>
		<img src="../uploadfile/upfile/<?php echo($image)?>" id="img" width="100" height="100" onmouseover="showBigImg(event,'img')" onmouseout="hiddenBigImg()" />
		<input type="button" class="button" value="上传图片" onclick="window.open('../uploadfile/?h=image&img=img','_blank','width=350,height=150,left=500,top=300')">
		<input type="hidden" value="<?php echo($arr[1]->image)?>" id="image" name="image" /></td>
	</tr>
	<!--<tr>
		<td align="right" class="tdLeft">简介：</td>
		<td align="left" style="padding:3px;"><textarea name="content" style="width:700px;height:500px;visibility:hidden;"><?php echo($arr[1]->content)?></textarea></td>
	</tr>-->
	<tr>
		<td align="right" class="tdLeft">首页排序：<span class="red">*</span></td>
		<td align="left"><input type="text" class="text" value="<?php echo($arr[1]->indexSort)?>" name="indexSort"></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">本类排序：<span class="red">*</span></td>
		<td align="left"><input type="text" class="text" value="<?php echo($arr[1]->classSort)?>" name="classSort"></td>
	</tr>
	<tr style="display:none">
		<td align="right" class="tdLeft">添加时间：</td>
	  	<td align="left"><input type="text" name="addTime" class="text60" style="width:70px;" value="<?php echo($arr[1]->addTime)?>" readonly="true" onFocus="new Calendar().show(this)"></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit"   value="提交" class="button"></td>
	</tr>
	</form>
</table>
</div>
</body>
</html>
