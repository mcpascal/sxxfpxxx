<div class="top">
	<div class="top-1">
		<DIV class="top-2" style="width:400px;">您好，欢迎来到晋城安科职业培训学校！今天是 <?php echo(date("Y-m-d"))?></DIV>
		<DIV class="top-3" style="width:500px;">
			<?php
			$username = isset($_COOKIE["username"])?isset($_COOKIE["username"]):"";
			if($username != ""){
			?>
				<span style=" padding-right:100px; font-weight:bold; color:#FF0000">欢迎您：<?php echo($username);?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="loginOut.php" style=" color:#FF0000">[退出]</a></span>
			<?php
			}
			?>
			<a href="javascript:setHome(window.location);">[设为首页]</a>&nbsp;&nbsp;&nbsp;<a href="javascript:addFavorite(window.location,document.title)">[加入收藏]</a>
		</DIV>
	</div>
</div>