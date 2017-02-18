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
include("class/Page.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$upClassId = 3;
$id=isset($_GET["id"])?(int)$_GET["id"]:6;
$newsClassData=new NewsClassData();
$arr=$newsClassData->getInfoById($id);
$className="";
if($arr[0]){
	$className=$arr[1]->name;
}else{
	$arr=$newsClassData->getTopOneInfo($upClassId);
	if($arr[0]){
		$className=$arr[1]->name;
		$id=$arr[1]->id;
	}
}
?>
<title><?php echo($className)?>-<?php echo($webSetting->webName)?></title>
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
		$headId = 6;
		include("Head1.php");
		?>
		<Div class="main-2">
			<div class="left"><img src="images/left-top-3.gif" />
				<div class="left-k">
					<ul>
					<?php
					$newsClassData=new NewsClassData();
					$newsClassData->listAll($upClassId);
					for($i=0;$i<count($newsClassData->arrAll);$i++){
					?>
					<li<?php if($newsClassData->arrAll[$i]->id==$id){echo(" class=\"cu\"");}?>><a href="?id=<?php echo($newsClassData->arrAll[$i]->id);?>"><?php echo($newsClassData->arrAll[$i]->name);?></a></li>
					<?php
					}
					?>
					</ul>
				</div>
				<?php include("Left.php"); ?>
			</div>
			<div class="right">
				<div class="right-top">
					<div class="right-biao"><?php echo $className?></div>
					<div class="home"><img src="images/home.gif" />&nbsp;&nbsp;您当前位置：网站首页 > 教学资料 > <?php echo $className?></div>
				</div>
				<div class="right-main">
					<ul>
					<?php
					$pageListNumber=18;
					$p=isset($_GET["page"])?$_GET["page"]:1;
					if(is_numeric($p)){
						$p=(int)$p;
					}else{
						$p=1;
					}
					$page=new Page(0,0,$pageListNumber,$p);
					$sql="select * from tbl_news where newsClassId=".$id." order by classSort asc, id desc";
					$newsData=new NewsData();
					$arr=$newsData->listBySql($sql,$page);
					for($i=0;$i<count($arr[1]);$i++){
					?>
					<li><span><?php echo $arr[1][$i]->addTime ?></span><a href="newsShow.php?id=<?php echo $arr[1][$i]->id?>" target="_blank"><?php echo $arr[1][$i]->title ?></a></li>
					</li>
					<?php
					}
					?>
					</ul>
					<div class="fanye">
						<ul>
						<li style="width:50px;"><a href="?id=<?php echo $id;?>&page=1">首页</a></li>
						<li style="width:50px;"><a href="?id=<?php echo $id;?>&page=<?php echo $arr[0]->currentPage-1;?>">上一页</a></li>
						<?php 
						for($i=1;$i<=$arr[0]->pageNumber;$i++){
						?>
						<li<?php echo ($arr[0]->currentPage==$i?" class='dang'":"");?>><a href="?id=<?php echo $id;?>&page=<?php echo $i;?>"><?php echo $i;?></a></li>
						<?php }?>
						<li style="width:50px;"><a href="?id=<?php echo $id;?>&page=<?php echo $arr[0]->currentPage+1;?>">下一页</a></li>
						<li style="width:50px;"><a href="?id=<?php echo $id;?>&page=<?php echo $arr[0]->pageNumber;?>">尾页</a></li>
						</ul>
					</div>
				</div>
			</div>
		</Div>
	</div>
</div><br/>
<?php include("Bottom.php"); ?>
</body>
</html>
