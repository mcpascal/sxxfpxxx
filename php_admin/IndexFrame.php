<?php
session_start();
include("../include/Function.php");
include("../include/CheckLoginForAdmin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>indexFrame</title>
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/IndexFrame.js"></script>
</head>

<frameset rows="91,6,*,30" frameborder="no" border="0" framespacing="0" id="all">
  <frame src="Top.php" name="topFrame" scrolling="No" id="top" title="top" />
  <frame src="Topimg.php" name="topimg" scrolling="no" noresize="noresize" id="topimg" title="topimg" />
  <frameset cols="226,7,*" frameborder="no" border="0" framespacing="0" id="down">
	  <frame src="Left.php" name="left" scrolling="no"  id="left" />
	  <frame src="Leftimg.php" name="leftimg" scrolling="no" id="leftimg" />
	  <frame src="Main.php" name="main" id="main" />
  </frameset>
  <frame src="Bottom.php" name="bottomFrame" scrolling="No" id="bottom" title="bottom" />
</frameset><noframes>
<body></body></noframes>
</html>