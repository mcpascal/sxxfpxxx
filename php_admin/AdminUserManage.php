<?php
include("../config.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/AdminUser.php");
include(GI."/data/AdminUserData.php");
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
var del=new Delete("aSelectAll","AdminUserDel.php");
</script>
</head>


<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">管理员管理</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">	
	<tr>
		<td align="center" width="80"><b>选择</b></td>
		<td align="center"><b>编号</b></td>
		<td align="center"><b>管理员名</b></td>
		<td align="center"><b>操作</b></td>
	</tr>
	<?php
	$adminUserData=new AdminUserData();
	$arr=$adminUserData->listAll();
	for($i=0;$i<count($arr);$i++){
	?>
		<tr id="tr<?php echo($i)?>" onMouseOver="javascript:changeTrbk('<?php echo($i);?>');" onMouseOut="javascript:changeTrbk1('<?php echo($i);?>');">
			<td align="center"><input type="checkbox" name="checkbox" id="checkbox" value="<?php echo($arr[$i]->id);?>_<?php echo($i)?>" /></td>
			<td align="center"><?php echo($arr[$i]->id);?></td>
			<td align="center"><?php echo($arr[$i]->userName);?></td>
			<td align="center"><a href="AdminUserChange.php?id=<?php echo($arr[$i]->id);?>">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:del.deleteOne('<?php echo($arr[$i]->id);?>','tr<?php echo($i)?>')">删除</a></td>
		</tr>
	<?php
	}
	?>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left" style="padding-left:10px;">
		<a id="aSelectAll" href="javascript:del.selectAll();">选择全部</a>&nbsp;&nbsp;&nbsp;<a href="javascript:del.deleteSelected();">删除所选</a>
		</td>
	</tr>
</table>
</body>
</html>
