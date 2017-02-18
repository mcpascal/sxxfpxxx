<?php
include("include/Header.php");
include("include/function.php");
include("config.php");
include("class/User.php");
include("data/UserData.php");
include("class/Judge.php");
include("data/JudgeData.php");
include("class/Select.php");
include("data/SelectData.php");
include("class/Score.php");
include("data/ScoreData.php");
include("Base.php");
if (!$webSetting->examOpen){
	alertAndBack("未到考试时间");
}
?>
<?php
$username = $_COOKIE["username"];
$pwd = $_COOKIE["pwd"];
$class = $_COOKIE["class"];
if(preg_match("/^[a-z0-9A-Z]{6,20}$/", $username) && preg_match("/^[a-z0-9A-Z]{32}$/", $pwd) && $class != ""){
	$userData=new UserData();
	$arr = $userData->login($username, $pwd);
	if(!$arr[0]){
		setcookie("username", "");
		setcookie("pwd", "");
		setcookie("class", "");
		gotoUrl("test.php");
	}
}else{
	setcookie("username", "");
	setcookie("pwd", "");
	setcookie("class", "");
	gotoUrl("test.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线考试-<?php echo($webSetting->webName)?></title>
<meta name="keywords" content="<?php echo($webSetting->webKeyWords)?>">
<meta name="description" content="<?php echo($webSetting->webDescription)?>">
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript">
function setPosition(){
	getWinWidthAndHeight();
	var bodyWidth = 1440, top = 370;
	var left = (winWidth - bodyWidth) / 2;
	left = left < 0 ? 250 : left + 250;
	top = winScrollTop > top ? winScrollTop : top;
	$$("divTime").style.left = left +"px";
	$$("divTime").style.top = top +"px";
	$$("divTime").style.display = "";
}
if(window.ActiveXObject){
	window.attachEvent("onload",begin);
	window.attachEvent("onload",setPosition);
	window.attachEvent("onresize",setPosition);
	window.attachEvent("onscorll",setPosition);
}else{
	window.addEventListener("load",setPosition,false);
	window.addEventListener("load",begin,false);
	window.addEventListener("resize",setPosition,false);
	window.addEventListener("scroll",setPosition,false);
}
var totleTime = 5400;
var timer;
function countDown(){
	if(totleTime <= 0){
		//document.test.submit();
		clearInterval(timer);
	}
	var s = totleTime % 60;
	var m=(totleTime - s) / 60;
	if(String(s).length == 1){
		s = "0" + String(s);
	}
	if(String(m).length == 1){
		m = "0" + String(m);
	}
	$$("time").innerHTML = m + ":" + s;
	totleTime -= 1;
}
function begin(){
	timer = setInterval(countDown,1000);
}

</script>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
</head>
<?php
$act = $_REQUEST["act"];
if($act == "ok"){
	$score = 0;
	$judgeIds = $_POST["judgeIds"];
	$select1Ids = $_POST["select1Ids"];
	$select2Ids = $_POST["select2Ids"];
	$arr1 = explode(",", $judgeIds);
	$arr2 = explode(",", $select1Ids);
	$arr3 = explode(",", $select2Ids);
	$j=new JudgeData();
	$s=new SelectData();
	for($i = 0; $i < count($arr1); $i ++){
		$r=$j->checkAnswer($arr1[$i], $_POST["judge" . $arr1[$i]]);
		if($r) $score += 0.5;
	}
	for($i = 0; $i < count($arr2); $i ++){
		$r=$s->checkAnswer($arr2[$i], $_POST["select1" . $arr2[$i]]);
		if($r) $score += 0.5;
	}
	for($i = 0; $i < count($arr3); $i ++){
		$answerArr = $_POST["select2" . $arr3[$i]];
		$answer = "";
		if(count($answerArr) > 0){
			foreach($answerArr as $k => $v){
				$answer .= $v;
			}
		}
		$r=$s->checkAnswer($arr3[$i],$answer);
		if($r) $score += 0.5;
	}
	$r = new Score($_COOKIE["class"], $username, $score, date("Y-m-d H:i:s"));
	$rd = new ScoreData();
	$rd->add($r);
	alertAndGo("得分为：" . $score, "index.php");
}
$classArr = explode("|", $webSetting->majorType);
if($act == "change"){
	$classname = $_POST["classname"];
	if(in_array($classname, $classArr)){
		setcookie("class", $classname);
	}else{
		setcookie("class", $classArr[0]);
	}
	gotoUrl("test-2.php");
}
?>
<body>
<?php include("Head.php"); ?>
<div class="main">
	<div class="main-1">
		<?php
		$headId = 7;
		include("Head1.php");
		?>
		<Div class="main-2">
			
			<div class="left">
				<div id="divTime" class="left-k" style=" left:0; top:0; position:absolute; z-index:999; display:none;padding:5px; width:200px; font-size:14px; height:130px; background:#e8f1f6;">
					欢迎您使用安科职业培训学校在线考试系统，请您认真答题。<br/>您的答题时间还剩于 <span class="zi" id="time" style=" font-weight:bold"></span>
					<table width="200" border="0" cellpadding="0" cellspacing="0" style="float:left; margin-top:10px;">
					  <tr>
						<td width="95" height="40"><img src="images/kaoshi.gif" onclick="document.test.submit()" style="cursor:pointer" /></td>
						<td width="95"><img src="images/kaoshi-1.gif" style="display:none" /></td>
					  </tr>
				  </table>
				</div>
		  </div>
			<div class="right-1">
				<div class="zi-1">
					
					<strong>晋城市安科职业培训学校在线考试系统</strong><Br/>
					<form name="form" method="post" action="?act=change">
					  	<td colspan="2" height="30">
						<select class="select" name="classname" onchange="document.form.submit()">
						<?php 
						foreach($classArr as $c){
							echo '<option value="' . $c . '"';
							if($class == $c){echo ' selected="selected"';}
							echo '>' . $c . '</option>';
						}
						?>
						</select>
						
						</td>
					  </form>
					<span class="zi-2">总分100分（60分过关）</span><Br/>
				</div>
				<form name="test" action="?act=ok" method="post">
					<div class="testTitle">一、判断题</div>
					<ul>
					<?php
					$judgeIds = "";
					$judgeD = new JudgeData();
					$arr = $judgeD->listRandom(60,$_COOKIE["class"]);
					for($i=0; $i<count($arr); $i ++){
						$judgeIds == "" ? $judgeIds = $arr[$i]->id : $judgeIds .= "," . $arr[$i]->id;
					?>
					<li>
						<div class="kaoshi">
							<div class="kaoshi-top"><strong><?php echo($i+1);?>.</strong><?php echo($arr[$i]->title)?></div>
							<ul>
							  <input type="radio" name="judge<?php echo($arr[$i]->id)?>" value="1"/>
							  对　　
							  <input type="radio" name="judge<?php echo($arr[$i]->id)?>" value="0"/>
							  错
							</ul>
						</div>
					</li>
					<?php
					}
					?>
						<input type="hidden" name="judgeIds" value="<?php echo($judgeIds);?>" />
					</ul>
					<div class="testTitle">二、单选</div>
					<ul>
					<?php
					$select1Ids = "";
					$selectD=new SelectData();
					$arr = $selectD->listRandom(1,100,$_COOKIE["class"]);
					for($i=0; $i<count($arr); $i ++){
						$select1Ids == "" ? $select1Ids = $arr[$i]->id : $select1Ids .= "," . $arr[$i]->id;
					?>
					<li>
						<div class="kaoshi">
							<div class="kaoshi-top"><strong><?php echo($i+1);?>.</strong><?php echo($arr[$i]->title)?></div>
							<ul>
							<li>
							  <input type="radio" name="select1<?php echo($arr[$i]->id)?>" value="a"/>
							  A、<?php echo($arr[$i]->a)?></li>
							<li>
							  <label>
							  <input type="radio" name="select1<?php echo($arr[$i]->id)?>" value="b"/>
							  </label>
							  B、<?php echo($arr[$i]->b)?></li>
							<li>
							  <label>
							  <input type="radio" name="select1<?php echo($arr[$i]->id)?>" value="c"/>
							  </label>
							  C、<?php echo($arr[$i]->c)?></li>
							<li>
							  <label>
							  <input type="radio" name="select1<?php echo($arr[$i]->id)?>" value="d"/>
							  </label>
							  D、<?php echo($arr[$i]->d)?></li>
							</ul>
						</div>
					</li>
					<?php
					}
					?>
						<input type="hidden" name="select1Ids" value="<?php echo($select1Ids);?>" />
					</ul>
					<div class="testTitle">三、多选</div>
					<ul>
					<?php
					$select2Ids = "";
					$selectD=new SelectData();
					$arr = $selectD->listRandom(2,40,$_COOKIE["class"]);
					for($i=0; $i<count($arr); $i ++){
						$select2Ids == "" ? $select2Ids = $arr[$i]->id : $select2Ids .= "," . $arr[$i]->id;
					?>
					<li>
						<div class="kaoshi">
							<div class="kaoshi-top"><strong><?php echo($i+1);?>.</strong><?php echo($arr[$i]->title)?></div>
							<ul>
							<li>
							  <input type="checkbox" name="select2<?php echo($arr[$i]->id)?>[]" value="a"/>
							  A、<?php echo($arr[$i]->a)?></li>
							<li>
							  <input type="checkbox" name="select2<?php echo($arr[$i]->id)?>[]" value="b"/>
							  B、<?php echo($arr[$i]->b)?> </li>
							<li>
							  <input type="checkbox" name="select2<?php echo($arr[$i]->id)?>[]" value="c"/>
							  C、<?php echo($arr[$i]->c)?> </li>
							<li>
							  <input type="checkbox" name="select2<?php echo($arr[$i]->id)?>[]" value="d"/>
							  D、<?php echo($arr[$i]->d)?></li>
							</ul>
						</div>
					</li>
					<?php
					}
					?>
						<input type="hidden" name="select2Ids" value="<?php echo($select2Ids);?>" />
					</ul>
					<table width="100%" border="0" style="float:left; margin-top:20px;">
					  <tr>
						<td align="center"><input type="image" src="images/kaoshi-2.gif" /></td>
					  </tr>
					</table>
                </form>
			</div>
		</Div>
	</div>
</div><br/>
<?php include("Bottom.php"); ?>
</body>
</html>
