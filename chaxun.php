<?php
include("include.php");
/*include("include/function.php");
include("config.php");
include("class/User.php");
include("data/UserData.php");
include("class/Score.php");
include("data/ScoreData.php");
include("Base.php");
include("include/CheckValue.php");*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>成绩查询-<?php echo($webSetting->webName)?></title>
<meta name="keywords" content="<?php echo($webSetting->webKeyWords)?>">
<meta name="description" content="<?php echo($webSetting->webDescription)?>">
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/CheckValue.js"></script>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script  type="text/javascript">
function checkForm(obj){
	var checkValue = new CheckValue();
	if(obj.type.value == "1"){
		if(checkValue.checkNull(obj.key.value,"请填写用户名"))return false;
		if(!checkValue.checkReg(obj.key.value,/^[a-z0-9A-Z]{6,20}$/,"用户名格式错误"))return false;
	}else{
		if(checkValue.checkNull(obj.key.value,"请填写身份证号"))return false;
		if(!checkValue.checkReg(obj.key.value,/^[1-9](\d{16}|\d{13})[0-9xX]$/,"身份证格式错误"))return false;
	}
	
}
</script>
</head>

<body>
<?php include("Head.php"); ?>
<div class="main">
	<div class="main-1">
		<?php
		$headId = 8;
		include("Head1.php");
		?>
		<Div class="main-2">
			<div class="right-da">
				<div class="right-top" style="width:100%;">
					<div class="right-biao">成绩查询</div>
					<div class="home"><img src="images/home.gif" />&nbsp;&nbsp;您当前位置：网站首页 > 成绩查询</div>
				</div>
			  <div class="right-main-da">
			  		<div class="chaxun">
						<form action="?act=ok" method="post" onsubmit="return checkForm(this)">
							<table width="696" border="0" style="float:left; margin-top:77px; margin-left:20px;_margin-left:10px;">
							  <tr>
								<td width="123" style="font-size:16px;">选择查询类型：</td>
								<td width="203"><select name="type" style="line-height:40px; height:40px; font-size:16px; color:#696969; width:180px;">
								  <option value="1">用户名</option>
								  <option value="2">身份证号</option>
								</select></td>
								<td width="238">
								  <input name="key" type="text" style="height:34px; line-height:34px; font-size:16px;color:#696969;" size="25" /></td>
								<td width="114"><input type="image" src="images/chaxun-1.gif" width="107" height="42" /></td>
							  </tr>
							</table>
						</form>
					</div><br/>
					<style type="text/css">
					.score{ margin:0px  auto 0 auto; text-align:center; width:730px; text-align:left;}
					.score table{ border-top:1px solid #E1E1E1; border-left:1px solid #E1E1E1;}
					.score td{ border-bottom:1px solid #E1E1E1; border-right:1px solid #E1E1E1; height:35px; text-align:center}
					.score .title{ background-color:#F3F3F3}
					</style>
					<?php
					$act = isset($_REQUEST["act"])?$_REQUEST["act"]:"";
					if($act == "ok"){
						$CheckValue=new CheckValue();
						$scoreData=new ScoreData();
						$userData = new UserData();
						if($_POST["type"] == "1"){
							$CheckValue->checkNull("用户名",$_POST["key"]);
							$CheckValue->checkReg("用户名",$_POST["key"],"/^[a-z0-9A-Z]{6,20}$/");
							
						}else{
							$CheckValue->checkNull("身份证",$_POST["key"]);
							$CheckValue->checkReg("身份证",$_POST["key"],"/^[1-9](\d{16}|\d{13})[0-9xX]$/");
						}
						$arr=$userData->getInfoByUserNameOrCard($_POST["key"]);
						if(!$arr[0]){
							alertAndBack("会员不存在");
						}
						$scoreArr = $scoreData->listAllByUserName($arr[1]->username);
						if(count($scoreArr) == 0){
							alertAndBack("暂无成绩");
						}
					
					?>
					<div class="score">
						查询结果如下：
						<table cellpadding="0" cellspacing="0" border="0" width="730">
							<tr class="title">
								<td>用户名</td>
								<td>姓名</td>
								<td>类别</td>
								<td>成绩</td>
								<td>时间</td>
								<td>结果</td>
							</tr>
						<?php
						$ret = true;
						foreach($scoreArr as $a){
							if($a->score>=60){
								$msg = '合格';
								$ret =  true;
							}else{
								$msg = '不合格';
								$ret =  false;
							}
						?>
							<tr>
								<td><?php echo $a->username;?></td>
								<td><?php echo $arr[1]->realname;?></td>
								<td><?php echo $a->classname;?></td>
								<td><?php echo $a->score;?></td>
								<td><?php echo $a->addtime;?></td>
								<td><?php echo $msg;?></td>
							</tr>
						<?php
							if($ret == true){
								$show = '通过';
							}else{
								$show = '未通过';
							}
						}
						?>
						
						<tr>
						<td colspan="6"  style="text-align:right"><font color="red"><b>本次考试<?php echo $show; ?></b></font></td>
						</tr>
						</table>
					</div>
					<?php
					}
					?>
			  </div>
			</div>
		</Div>
	</div>
</div><br/>
<?php include("Bottom.php"); ?>
</body>
</html>
