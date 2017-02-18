<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/Product.php");
include(GI."/data/ProductData.php");
include(GI."/class/ProductClass.php");
include(GI."/data/ProductClassData.php");
include(GI."/class/Page.php");
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
<script type="text/javascript" src="js/XmlHttpRequest.js"></script>
<script type="text/javascript" src="js/Delete.js"></script>
<script type="text/javascript" src="js/Admin.js"></script>
<script type="text/javascript">
var del=new Delete("aSelectAll","ProductDel.php");
</script>
</head>

<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">产品管理</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr class="tdTitle">
		<td align="center"><b>选择</b></td>
		<td align="center"><b>编号</b></td>
		<td align="center"><b>所属类别</b></td>
		<td align="center"><b>产品名称</b></td>
		<td align="center"><b>首页排序</b></td>
		<td align="center"><b>本类排序</b></td>
		<td align="center"><b>操作</b></td>
	</tr>
	<?php
	$pageListNumber=20;
	$p=$_GET["page"];
	if(is_numeric($p)){
		$p=(int)$p;
	}else{
		$p=1;
	}
	$page=new Page(0,0,$pageListNumber,$p);
	$sql="select * from tbl_product order by id desc";
	$productData=new ProductData();
	$arr=$productData->listBySql($sql,$page);
	for($i=0;$i<count($arr[1]);$i++){
	?>
		<tr id="tr<?php echo($i)?>" onMouseOver="javascript:changeTrbk('<?php echo($i);?>');" onMouseOut="javascript:changeTrbk1('<?php echo($i);?>');">
			<td align="center"><input type="checkbox" name="checkbox" id="checkbox" value="<?php echo($arr[1][$i]->id);?>_<?php echo($i)?>" /></td>
			<td align="center"><?php echo($arr[1][$i]->id);?></td>
			<td align="center">
			<?php 
			$productClassData=new ProductClassData();
			$arr1=$productClassData->getInfoById($arr[1][$i]->productClassId);
			$arr1[0]?print($arr1[1]->name):print("未找到该类别");
			?>
			</td>
			<td align="center"><?php echo($arr[1][$i]->title);?></td>
			<td align="center"><?php echo($arr[1][$i]->indexSort);?></td>
			<td align="center"><?php echo($arr[1][$i]->classSort);?></td>
			<td align="center" style="padding-right:20px;"><a href="ProductChange.php?id=<?php echo($arr[1][$i]->id);?>">修改</a>&nbsp;&nbsp;<a href="javascript:del.deleteOne('<?php echo($arr[1][$i]->id);?>','tr<?php echo($i)?>')">删除</a></td>
		</tr>
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
		<a href="?page=1">首页</a>  
		<a href="?page=<?php echo($arr[0]->currentPage-1)?>">上一页</a>  
		<a href="?page=<?php echo($arr[0]->currentPage+1)?>">下一页</a>  
		<a href="?page=<?php echo($arr[0]->pageNumber)?>">尾页</a>
		</td>
	</tr>
</table>
</body>
</html>
