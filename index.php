<?php
require_once("include.php");
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($webSetting->webName)?>-首页</title>
<meta name="keywords" content="<?php echo($webSetting->webKeyWords)?>">
<meta name="description" content="<?php echo($webSetting->webDescription)?>">
<script type="text/javascript" src="js/Function.js"></script>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript" src="source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.fancybox').fancybox();
});
</script>
</head>

<body>
<?php include("Head.php"); ?>
<div class="main">
	<div class="main-1">
		<?php
		$headId = 1;
		include("Head1.php");
		?>
		<Div class="main-2">
			<div class="news-tu">
				<script type="text/javascript" src="js/myfocus-2.0.4.min.js"></script>
				<script type="text/javascript">
				myFocus.set({
					id:'myFocus',
					pattern:'mF_classicHC'
				});
				</script>
				<div id="myFocus" style="width:282px; height:194px; overflow:hidden;"><!--焦点图盒子-->
					<div class="pic"><!--图片列表-->
					<ul>
					<?php 
					$news=new NewsData();
					$arr=$news->listNumberInClass(6,"4,5",1);
					for($i=0;$i<count($arr);$i++){ 
						$arr[$i]->image==""?$img="uploadfile/upfile/null.png":$img="uploadfile/upfile/".$arr[$i]->image;
					?>
						<li><a href="newsShow.php?id=<?php echo $arr[$i]->id ?>" target="_blank"><img src="<?php echo $img ?>" thumb="<?php echo $arr[$i]->title ?>" alt="<?php echo $arr[$i]->title ?>" text="<?php echo $arr[$i]->title ?>" width="282" height="194" /></a></li>
					<?php }?>
					</ul>
					</div>
				</div>
			</div>
			<div class="news">
				<div class="news-top">
					<ul>
					<li onmouseover="this.className = 'pp'; $$('newLi2').className = ''; $$('newsDiv1').style.display = ''; $$('newsDiv2').style.display = 'none';" id="newLi1" class="pp"><a href="news.php?id=4">学校动态</a></li>
					<li onmouseover="this.className = 'pp'; $$('newLi1').className = ''; $$('newsDiv2').style.display = ''; $$('newsDiv1').style.display = 'none';" id="newLi2"><a href="news.php?id=5">行业资讯</a></li>
					</ul>
				</div>
				<div id="newsDiv1">
					<ul>
					<?php 
					$news=new NewsData();
					$arr=$news->listNumberInClass(6,"4");
					for($i=0;$i<count($arr);$i++){ 
					?>
					<li><span><?php echo $arr[$i]->addTime ?></span><a href="newsShow.php?id=<?php echo $arr[$i]->id ?>" target="_blank"><?php echo cutStr($arr[$i]->title,32) ?></a></li>
					<?php }?>
					</ul>
				</div>
				<div id="newsDiv2" style="display:none">
					<ul>
					<?php 
					$news=new NewsData();
					$arr=$news->listNumberInClass(6,"5");
					for($i=0;$i<count($arr);$i++){ 
					?>
					<li><span><?php echo $arr[$i]->addTime ?></span><a href="newsShow.php?id=<?php echo $arr[$i]->id ?>" target="_blank"><?php echo cutStr($arr[$i]->title,32) ?></a></li>
					<?php }?>
					</ul>
				</div>
			</div>
			<div class="kaiban">
				<div class="kaiban-top"><img src="images/kaiban.gif" border="0" usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="196,8,235,32" href="kaiban.php" /></map></div>
				<div class="kaiban-main">
					<ul>
					<?php 
					$news=new NewsData();
					$arr=$news->listNumberInClass(6,"8");
					for($i=0;$i<count($arr);$i++){ 
					?>
					<li><a href="newsShow.php?id=<?php echo $arr[$i]->id ?>" target="_blank"><?php echo cutStr($arr[$i]->title,26) ?></a></li>
					<?php }?>
					</ul>
				</div>
			</div>
			<div class="about"><img src="images/about.gif" border="0" usemap="#Map2" />
<map name="Map2" id="Map2"><area shape="rect" coords="611,3,663,25" href="about.php" /></map>
				<div class="about-main" style="text-indent:26px; height:140px;">
				<?php 
				$s=new SinglePageData();
				$arr=$s->getInfoById(1);
				echo $arr[0]?cutStr($arr[1]->content,450):"";
				?>
				</div>
		  </div>
			<div class="about-1">
				<img src="images/about-1.gif" border="0" usemap="#Map3" />
				<map name="Map3" id="Map3">
					<area shape="rect" coords="3,4,236,40" href="about.php?id=2" />
					<area shape="rect" coords="7,50,235,85" href="about.php?id=3" />
					<area shape="rect" coords="9,95,235,133" href="ziliao.php?id=7" />
					<area shape="rect" coords="8,141,240,177" href="about.php?id=4" />
				</map>
			</div>
			<div class="guanggao"><img src="images/tu.gif" /></div>
			<div class="guanggao-1"><a href="baoming.php"><img src="images/tu-1.gif" border="0" /></a></div>
			<div class="kon">
				<div class="kon-top">教学资料</div>
				<div class="kon-more"><a href="ziliao.php">更多>></a></div>
				<ul>
				<?php 
				$news=new NewsData();
				$arr=$news->listNumberInClass(6,"6");
				for($i=0;$i<count($arr);$i++){ 
				?>
				<li><a href="newsShow.php?id=<?php echo $arr[$i]->id ?>" target="_blank"><?php echo cutStr($arr[$i]->title,40) ?></a></li>
				<?php }?>
				</ul>
			</div>
			<div class="kon" style="margin-left:12px;">
				<div class="kon-top">消防知识</div>
				<div class="kon-more"><a href="ziliao.php?id=7">更多>></a></div>
				<ul>
				<?php 
				$news=new NewsData();
				$arr=$news->listNumberInClass(6,"7");
				for($i=0;$i<count($arr);$i++){ 
				?>
				<li><a href="newsShow.php?id=<?php echo $arr[$i]->id ?>" target="_blank"><?php echo cutStr($arr[$i]->title,40) ?></a></li>
				<?php }?>
				</ul>
			</div>
			<div class="xiangmu">
				<div class="xiangmu-top"><img src="images/xiangmu.gif" /></div>
				<div class="xiangmu-main">
					<a href="peixun.php?id=13">消防项目培训</a><Br/>
					<a href="peixun.php?id=14"><span style="float:left; margin-top:32px;">其他职业资格培训</span></a>			  </div>
			</div>
			<Div class="chengji"><a href="chaxun.php"><img src="images/chengji.gif" border="0" /></a></Div>
			<div class="huanjing"><img src="images/huanjing.gif" border="0" />
				<div id="rcolee_left" style="overflow: hidden; width:904px; margin:0 10px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
					  <td id="rcolee_left1"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
					<?php 
					$p=new ProductData();
					$arr=$p->listAllByProductClassId(1);
					for($i=0;$i<count($arr)&&$i<999999;$i++){
					?>
						<td><ul><li><a class="fancybox" href="uploadfile/upfile/<?php echo($arr[$i]->image)?>" data-fancybox-group="gallery" title="<?php echo($arr[$i]->title)?>"><img src="uploadfile/upfile/<?php echo $arr[$i]->image;?>" border="0" width="181" height="131" /></a><?php echo $arr[$i]->title;?></li></ul></td>
					<?php 
					}
					?>
						</tr></table></td>
					  <td id="rcolee_left2"></td>
					</tr>
				</table>
				<script type="text/javascript">
				var rspeed = 15; //速度数值越大速度越慢
				var rcolee_left2 = document.getElementById("rcolee_left2");
				var rcolee_left1 = document.getElementById("rcolee_left1");
				var rcolee_left = document.getElementById("rcolee_left");
				rcolee_left2.innerHTML = rcolee_left1.innerHTML;
				function rMarquee3() {
					if (rcolee_left2.offsetWidth - rcolee_left.scrollLeft <= 0) { //offsetWidth 是对象的可见宽度
						rcolee_left.scrollLeft -= rcolee_left1.offsetWidth; //scrollWidth 是对象的实际内容的宽，不包边线宽度
					} else {
						rcolee_left.scrollLeft++;
					}
				}
				var rMyMar3 = setInterval(rMarquee3, rspeed);
				rcolee_left.onmouseover = function() {
					clearInterval(rMyMar3);
				}
				rcolee_left.onmouseout = function() {
					rMyMar3 = setInterval(rMarquee3, rspeed);
				}
				</script>
			</div>
				<!--<ul>
				<li><img src="images/tu-1.jpg" />实操课程场地</li>
				<li><img src="images/tu-1.jpg" />实操课程场地</li>
				<li><img src="images/tu-1.jpg" />实操课程场地</li>
				<li><img src="images/tu-1.jpg" />实操课程场地</li>
				</ul>-->
		  </div>
		</Div>
	</div>
</div><br/>
<?php include("Bottom.php"); ?>
</body>
</html>
