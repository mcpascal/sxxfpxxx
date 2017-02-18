<?php
include("Tree.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>top</title>
<link href="css/Top.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/Top.js"></script>

<body class="topBody">
	<a href="http://www.goodidea199.com"/ target="_blank"><img src="images/logo.png" class="topLogo" /></a>
	<div class="top1">
		<?php
		for($i=0;$i<count($class);$i++){
		?>
		<a id="a<?php echo($i)?>"<?php if($i==0){echo(" class='aSelect'");}?> href="#" onclick="changeLeftTree(<?php echo($i)?>,<?php echo(count($class))?>)"><?php echo($class[$i])?></a>
		<?php
		}
		?>
	</div>
	<img src="images/loginOut.png" class="topLoginOut" onclick="window.top.exit()" />
</body>
</html>