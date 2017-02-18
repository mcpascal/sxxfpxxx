<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站管理系统</title>
<link href="css/Index.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/XmlHttpRequest.js"></script>
<script type="text/javascript" src="js/Index.js"></script>
<script type="text/javascript">
var ifLeave="<?php echo($_SESSION["adminIfLeave"]);?>";
var bg=new background();
var win1=new windows();
var win2=new windows();
var win3=new windows();
var right=new right();
</script>

<body class="indexBody">
<div id="bg" class="indexBg" style="display:none; width:10px; height:10px; left:0px; top:0px;"></div>
<div id="win1" class="indexWin1" style="width:362px; height:173px; left:300px; top:300px; display:none; background-image:url(images/winBg1.jpg)">
	<div id="win1Title" class="indexWin1Title">提示</div>
	<div class="indexWin1Close"><img src="images/close.jpg" onclick="win1.win1Hidden()" /></div>
	<div id="win1Content" class="indexWin1Content">您确定执行此操作码？</div>
	<div class="indexWin1Button"><img src="images/ok.jpg" onclick="win1.win1Eval()" /><img src="images/cancle.jpg" id="win1CancleButton" onclick="win1.win1Hidden()" style="display:;" /></div>
</div>
<div id="win2" class="indexWin2" style="width:362px; height:173px; left:300px; top:300px; display:none;background-image:url(images/winBg1.jpg)">
	<div id="win2Title" class="indexWin2Title">请输入密码</div>
	<div id="win2Content" class="indexWin2Content">
		密码：<input type="password" id="win2Password" class="text" />
	</div>
	<div id="win2Err" class="indexWin2Err">请输入密码</div>
	<div class="indexWin2Button"><img src="images/ok.jpg" onclick="win2.win2Eval()" /></div>
</div>
<div id="win3" class="indexWin3" style="left:100px; top:100px; display:none;">
	<div id="win3Img" class="indexWin3Img"><img src="images/dui.png" /></div>
	<div id="win3Content" class="indexWin3Content">操作成功</div>
</div>
<div id="right" class="indexRight" style="display:; left:0; top:-320px;width:57px; height:320px;">
	<img src="images/1.png" onclick="leave()" />
	<img src="images/2.png" onclick="exit()" />
	<img src="images/3.png" onclick="$('iframe').src='IndexFrame.php';" />
	<img src="images/4.png" />
</div>
<iframe id="iframe" scrolling="no" height="9000" width="100%" src="IndexFrame.php" frameborder="0" hspace="0"></iframe>
</body>
</html>