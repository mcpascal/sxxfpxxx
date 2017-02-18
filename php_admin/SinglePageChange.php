<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/SinglePage.php");
include(GI."/data/SinglePageData.php");
include(GI."/class/SinglePageClass.php");
include(GI."/data/SinglePageClassData.php");
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
<link rel="stylesheet" href="../kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="../kindeditor/plugins/code/prettify.css" />
<script type="text/javascript" src="js/CheckValueNotAlert.js"></script>
<script type="text/javascript" src="js/Admin.js"></script>
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
	if(!checkValue.checkReg("类别",obj.singlePageClassId.value,/^\d{1,}$/))return false;
	if(checkValue.checkNull("页面名称",obj.title.value))return false;
	if(!checkValue.checkReg("排序",obj.sort1.value,/^\d{1,5}$/))return false;
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
	$CheckValueNotAlert->checkReg("类别",$_POST["singlePageClassId"],"/^\d{1,5}$/");
	$CheckValueNotAlert->checkNull("页面名称",$_POST["title"]);
	$CheckValueNotAlert->checkReg("排序",$_POST["sort1"],"/^\d{1,5}$/");
	$singlePage=new SinglePage($_POST["singlePageClassId"],$_POST["title"],$_POST["content"],$_POST["sort1"],$id);
	$singlePageData=new SinglePageData();
	$singlePageData->change($singlePage)?done(1,"SinglePageManage.php"):done(0);
}
$singlePageData=new SinglePageData();
$arr=$singlePageData->getInfoById($id);
if(!$arr[0]){
	done(0);
}
?>
<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">单页面修改</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<form action="?act=ok&id=<?php echo($id)?>" method="post" name="form1" onsubmit="return checkForm(this);">
	<tr>
		<td width="15%" align="right" class="tdLeft">类别：<span class="red">*</span></td>
		<td align="left">
		<select name="singlePageClassId" class="select">
			<?php
			$singlePageClassData=new SinglePageClassData();
			$singlePageClassData->listAll(0);
			for($i=0;$i<count($singlePageClassData->arrAll);$i++){
			?>
				<option value="<?php echo($singlePageClassData->arrAll[$i]->id);?>"<?php if($arr[1]->singlePageClassId==$singlePageClassData->arrAll[$i]->id){echo(" selected=\"selected\"");}?>>
				<?php
				for($j=1;$j<($singlePageClassData->arrAll[$i]->grade-1)*5;$j++){echo("&nbsp;");}
				?>
				<?php echo($singlePageClassData->arrAll[$i]->name);?></option>
			<?php
			}
			?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">页面名称：</td>
		<td align="left"><input type="text" class="text" name="title" value="<?php echo($arr[1]->title)?>" /></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">内容：</td>
		<td align="left" style="padding:3px;"><textarea name="content" style="width:700px;height:500px;visibility:hidden;"><?php echo htmlspecialchars($content); ?><?php echo($arr[1]->content)?></textarea></td>
	</tr>
	<tr>
		<td align="right" class="tdLeft">本类排序：<span class="red">*</span></td>
		<td align="left"><input type="text" class="text60" value="<?php echo($arr[1]->sort)?>" name="sort1"></td>
	</tr>	
	<tr>
		<td></td>
		<td align="center"><input type="submit"   value="提交" class="button"></td>
	</tr>
	</form>
</table>
</div>
</body>
</html>
