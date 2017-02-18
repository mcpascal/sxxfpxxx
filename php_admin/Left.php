<?php
include("Tree.php");
$id=$_GET["id"];
if(!is_numeric($id)){
	$id=(int)$id;
}
if($id>count($class)||$id<0){
	$id=0;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>left</title>
<link href="css/Left.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/Left.js"></script>
<script type="text/javascript">
var titleCount=<?php echo(count($title[$id]))?>;
</script>
</head>


<body>
<div class="all">
	<div class="className"><a href="#" id="aChangeAll" onclick="javascript:changeAll()">全部收起</a></div>
	<?php
	$num=0;
	for ($i=0;$i<count($title[$id]);$i++){
		if($titleShow[$id][$i]){
	?>
		<div id="title<?php echo($i+1)?>" class="title" onmousemove="titleMouseOver('<?php echo($i+1)?>')" onmouseout="titleMouseOut('<?php echo($i+1)?>')" onclick="titleClick('<?php echo($i+1)?>')">
			<img src="images/smallimg/1.png" class="titleImg1" />
			<?php echo($title[$id][$i])?>
			<img id="titleImg<?php echo($i+1)?>" src="images/leftDown.png" class="titleImg2" />
		</div>
		<div id="linkCon<?php echo($i+1)?>" class="linkCon" style="display:;">
			<?php
			for($j=0;$j<count($aName[$id][$i]);$j++){
				if($aShow[$id][$i][$j]){
				$num+=1;
			?>
			<div class="link" id="a<?php echo($num)?>"><a href="<?php echo($aUrl[$id][$i][$j])?>" target="main"><?php echo($aName[$id][$i][$j])?></a></div>
			<?php
				}
			}
			?>
		</div>
	<?php
		}
	}
	?>
</div>

</body>
</html>
