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
include("class/SinglePageClass.php");
include("data/SinglePageClassData.php");

include("class/Baoming.php");
include("data/BaomingData.php");
include("Base.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$classId=3;
$className="";
$id=isset($_GET["id"])?$_GET["id"]:1;
$title="";
$content="";
$singlePageClassData=new SinglePageClassData();
$arr=$singlePageClassData->getInfoById($classId);
if($arr[0]){
	$className=$arr[1]->name;
}
$singlePageData=new SinglePageData();
if(is_numeric($id)){
	$id=(int)$id;
	$sql="select * from tbl_singlePage where singlePageClassId=".$classId." and id=".$id;
	$arr=$singlePageData->getInfoBySql($sql);
	if(!$arr[0]){
		$sql="select * from tbl_singlePage where singlePageClassId=".$classId." order by sort,id asc limit 1";
		$arr=$singlePageData->getInfoBySql($sql);
		if($arr[0]){
			$id=$arr[1]->id;
			$title=$arr[1]->title;
			$content=$arr[1]->content;
		}
	}else{
		$id=$arr[1]->id;
		$title=$arr[1]->title;
		$content=$arr[1]->content;
	}
}else{
	$sql="select * from tbl_singlePage where singlePageClassId=".$classId." order by sort asc,id asc limit 1";
	$arr=$singlePageData->getInfoBySql($sql);
	if($arr[0]){
		$id=$arr[1]->id;
		$title=$arr[1]->title;
		$content=$arr[1]->content;
	}
}
?>
<title><?php echo($title)?>-<?php echo($webSetting->webName)?></title>
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
		$headId = 10;
		include("Head1.php");
		?>
		<Div class="main-2">
			<div class="left">
				<?php include("Left1.php"); ?>
			</div>
			<div class="right">
				<div class="right-top">
					<div class="right-biao"><?php echo($title)?></div>
					<div class="home"><img src="images/home.gif" />&nbsp;&nbsp;您当前位置：网站首页 > <?php echo($title)?></div>
				</div>
				<div class="right-main">
					<?php echo($content);?>
				</div>
			</div>
		</Div>
	</div>
</div><br/>
<?php include("Bottom.php"); ?>
</body>
</html>
