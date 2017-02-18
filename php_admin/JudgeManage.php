<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/Judge.php");
include(GI."/data/JudgeData.php");
include(GI."/include/CheckValueNotAlert.php");
include(GI."/include/CheckLoginForAdmin.php");
include(GI."/class/Page.php");
include("BigImg.php");


include(GI."/class/WebSetting.php");
include(GI."/data/WebSettingData.php");
$webSetting=new WebSetting();
$webSettingData=new WebSettingData();
$webSetting=$webSettingData->getInfo();
$classArr = explode("|", $webSetting->majorType);
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
<script type="text/javascript" src="js/XmlHttpRequest.js"></script>
<script type="text/javascript" src="js/Delete.js"></script>
<script type="text/javascript" src="js/Admin.js"></script>
<script type="text/javascript">
var del=new Delete("aSelectAll","JudgeDel.php");
function checkForm(obj){
	var checkValue=new CheckValueNotAlert();
	if(checkValue.checkNull("题目",obj.title.value))return false;
}
</script>
<?php
$act = $_GET["act"];
if($act == "change"){
	$id = $_GET["id"];
	if(!is_numeric($id)){
		done(0);
	}
	$title = $_POST["title"];
	$answer = $_POST["answer"];
	$CheckValueNotAlert=new CheckValueNotAlert();
	$CheckValueNotAlert->checkNull("标题",$title);
	if($answer != "0" && $answer != "1"){
		$CheckValueNotAlert->message("值错误，操作失败");
	}
	$judgeData=new JudgeData();
	$arr=$judgeData->getInfoById($id);
	if(!$arr[0]){
		done(0);
	}
	$judge=new Judge($_POST["classname"],$_POST["title"],$_POST["answer"],$id);
	$judgeData->change($judge) ? done(1,"JudgeManage.php") : done(0);
}
?>
</head>

<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">判断题管理</div>
		<div class="title1Right">
		<form method="post" action="" onsubmit="">
			题目:<input type="text" name="key" class="text" value="" />
			<input type="submit" class="button" value="搜索" />
		</form>
		</div>
	</div>
</div> 
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr class="tdTitle">
		<td align="center"><b>选择</b></td>
		<td align="center"><b>编号</b></td>
		<td align="center"><b>类别</b></td>
		<td align="center"><b>题目</b></td>
		<td align="center"><b>结果</b></td>
		<td align="center"><b>操作</b></td>
	</tr>
	<?php
	$key = $_REQUEST["key"];
	$pageListNumber=20;
	$p=$_GET["page"];
	if(is_numeric($p)){
		$p=(int)$p;
	}else{
		$p=1;
	}
	$page=new Page(0,0,$pageListNumber,$p);
	$sql="select * from [/table/]";
	if($key != "") $sql .= " where title like '%{$key}%'";
	$sql .= " order by id desc";
	$judgeData=new JudgeData();
	$arr=$judgeData->listBySql($sql,$page);
	for($i=0;$i<count($arr[1]);$i++){
	?>
	<form method="post" action="?act=change&id=<?php echo($arr[1][$i]->id);?>" onsubmit="return checkForm(this)">
		<tr id="tr<?php echo($i)?>" onMouseOver="javascript:changeTrbk('<?php echo($i);?>');" onMouseOut="javascript:changeTrbk1('<?php echo($i);?>');">
			<td align="center"><input type="checkbox" name="checkbox" id="checkbox" value="<?php echo($arr[1][$i]->id);?>_<?php echo($i)?>" /></td>
			<td align="center"><?php echo($arr[1][$i]->id);?></td>
			<td align="center">
				<select class="select" name="classname">
				<?php 
				foreach($classArr as $c){
					echo '<option value="' . $c . '"';
					if($arr[1][$i]->classname == $c){echo 'selected="selected"';}
					echo '>' . $c . '</option>';
				}
				?>
				</select>
			</td>
			<td align="center"><input type="text"  class="text500" name="title"  value="<?php echo($arr[1][$i]->title);?>" /></td>
			<td align="center"><input type="radio" name="answer" value="0" checked="checked" />错&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="answer" value="1"<?php if($arr[1][$i]->answer){echo(' checked="checked"');}?> />对</td>
			<td align="center" style="padding-right:20px;"><input type="submit"   value="提交" class="button">&nbsp;&nbsp;<a href="javascript:del.deleteOne('<?php echo($arr[1][$i]->id);?>','tr<?php echo($i)?>')">删除</a></td>
		</tr>
	</form>
	<?php
	}
	?>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="center">
		<a id="aSelectAll" href="javascript:del.selectAll();">选择全部</a>&nbsp;&nbsp;&nbsp;<a href="javascript:del.deleteSelected();">删除所选</a>
		</td>
		<td align="right" style="padding-right:50px;">
		共<span class="red"><?php echo($arr[0]->allNumber)?></span>条记录  共<span class="red"><?php echo($arr[0]->pageNumber)?></span>页  每页显示<span class="red"><?php echo($arr[0]->pageListNumber)?></span>条   
		转到第<select name="goToPage" id="goToPage" onChange="javascript:goToPage();">
		<?php
			for($k=1;$k<=$arr[0]->pageNumber;$k++){
		?>
			<option value="?page=<?php echo($k)?>" <?php if ($k==$arr[0]->currentPage){ ?> selected="selected"<?php }?>><?php echo($k);?></option>
		<?php
			}
		?>
		</select>页  
		<a href="?page=1&key=<?php echo($key);?>">首页</a>  
		<a href="?page=<?php echo($arr[0]->currentPage-1)?>&key=<?php echo($key);?>">上一页</a>  
		<a href="?page=<?php echo($arr[0]->currentPage+1)?>&key=<?php echo($key);?>">下一页</a>  
		<a href="?page=<?php echo($arr[0]->pageNumber)?>&key=<?php echo($key);?>">尾页</a>
		</td>
	</tr>
</table>
</body>
</html>
