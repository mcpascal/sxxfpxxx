<?php
include("include/Header.php");
include("include/function.php");
include("config.php");
include("class/Product.php");
include("data/ProductData.php");
include("class/News.php");
include("data/NewsData.php");
include("class/NewsClass.php");
include("data/NewsClassData.php");
include("class/SinglePage.php");
include("data/SinglePageData.php");

include("class/Baoming.php");
include("data/BaomingData.php");
include("Base.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$id=(int)$_GET["id"];
$newsData=new NewsData();
$arr=$newsData->getInfoById($id);
if(!$arr[0])alertAndGo("该信息不存在","index.php");
$title=$arr[1]->title;
$content=$arr[1]->content;
$addTime=$arr[1]->addTime;
$classId=$arr[1]->newsClassId;
$newsClassData=new NewsClassData();
$arr=$newsClassData->getInfoById($classId);
if($arr[0])$className=$arr[1]->name;
?>
<title><?php echo($title)?>-<?php echo($className)?>-<?php echo($webSetting->webName)?></title>
<meta name="keywords" content="<?php echo($webSetting->webKeyWords)?>">
<meta name="description" content="<?php echo($webSetting->webDescription)?>">
<script type="text/javascript" src="js/Function.js"></script>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include("Head.php"); ?>
<div class="main">
	<div class="main-1">
		<?php
		$headId = 0;
		include("Head1.php");
		?>
		<Div class="main-2">
			<div class="right-da">
				<div class="right-top" style="width:100%;">
					<div class="right-biao"><?php echo($className)?></div>
					<div class="home"><img src="images/home.gif" />&nbsp;&nbsp;您当前位置：网站首页 > <?php echo($className)?></div>
				</div>
			  <div class="right-main-da">
			  		<div class="zi-7"><?php echo($title)?></div>
					<div class="zi-3">发表日期：<?php echo($addTime)?></div>
					<div class="zi-4"><?php echo($content)?></div>		
					<div class="zi-4">
						<?php
						$a=$newsData->getUpOrNextOne($id,$classId,"up");
						$txt="上一条：没有了";
						if($a[0])$txt='<a href="?id='.$a[1]->id.'">上一条：'.$a[1]->title.'</a>';
						?>
						<span class="zi-5"><?php echo($txt)?></span>
						<?php
						$a=$newsData->getUpOrNextOne($id,$classId,"next");
						$txt="下一条：没有了";
						if($a[0])$txt='<a href="?id='.$a[1]->id.'">下一条：'.$a[1]->title.'</a>';
						?>
						<span class="zi-6"><?php echo($txt)?></span>		
					</div>
			  </div>
			</div>
		</Div>
	</div>
</div><br/>
<?php include("Bottom.php"); ?>
</body>
</html>
