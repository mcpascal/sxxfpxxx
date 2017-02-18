<?php
include("include/Header.php");
include("include/function.php");
include("config.php");
include("class/Baoming.php");
include("data/BaomingData.php");
include("Base.php");
include("include/CheckValue.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线报名-<?php echo($webSetting->webName)?></title>
<meta name="keywords" content="<?php echo($webSetting->webKeyWords)?>">
<meta name="description" content="<?php echo($webSetting->webDescription)?>">
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/Date.js"></script>
<script type="text/javascript" src="js/CheckValue.js"></script>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function checkForm(obj){
	var checkValue=new CheckValue();
	if(checkValue.checkNull(obj.major.value,"请选择专业"))return false;
	if(checkValue.checkNull(obj.realname.value,"请填写姓名"))return false;
	if(!checkValue.checkLen(obj.realname.value,5,"姓名过长"))return false;
	if(checkValue.checkNull(obj.birthday.value,"请填写出生年月"))return false;
	if(!checkValue.checkReg(obj.birthday.value,/^\d{4}\-\d{2}\-\d{2}$/,"出生年月格式错误"))return false;
	if(checkValue.checkNull(obj.card.value,"请填写出身份证"))return false;
	if(!checkValue.checkReg(obj.card.value,/^[1-9](\d{16}|\d{13})[0-9xX]$/,"身份证格式错误"))return false;
	if(checkValue.checkNull(obj.education.value,"请选择学历"))return false;
	if(checkValue.checkNull(obj.job.value,"请填写职务"))return false;
	if(!checkValue.checkLen(obj.job.value,20,"职务过长"))return false;
	if(!checkValue.checkLen(obj.title.value,30,"职称过长"))return false;
	if(!checkValue.checkLen(obj.company.value,30,"工作单位过长"))return false;
	if(!checkValue.checkLen(obj.address.value,60,"地址过长"))return false;
	if(checkValue.checkNull(obj.phone.value,"请填写联系电话（手机号码）"))return false;
	if(!checkValue.checkReg(obj.phone.value,/^1[3458]\d{9}$/,"请填写正确的手机号码"))return false;
	if(!checkValue.checkLen(obj.address1.value,60,"通讯地址过长"))return false;
	if(obj.zipcode.value != ""){
		if(!checkValue.checkReg(obj.zipcode.value,/^\d{6}$/,"请填写正确的邮编"))return false;
	}
	if(obj.email.value != ""){
		if(!checkValue.checkReg(obj.email.value,/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/,"请填写正确的邮箱"))return false;
	}
	if(checkValue.checkNull(obj.code.value,"请填写验证码"))return false;
	if(!checkValue.checkReg(obj.code.value,/^[a-z0-9A-Z]{4}$/,"验证码格式错误"))return false;
}
</script>
<?php
$act=isset($_GET["act"])?$_GET["act"]:'';
if($act=="ok"){
	$CheckValue=new CheckValue();
	$CheckValue->checkNull("专业",$_POST["major"]);
	$CheckValue->checkLen("专业",$_POST["major"],50);
	$CheckValue->checkNull("姓名",$_POST["realname"]);
	$CheckValue->checkLen("姓名",$_POST["realname"],20);
	if($_POST["sex"] != "男" && $_POST["sex"] != "女"){
		alertAndBack("性别错误");
	}
	$CheckValue->checkReg("出生年月",$_POST["birthday"],"/^\d{4}\-\d{2}\-\d{2}$/");
	if(!isDate($_POST["birthday"])){
		alertAndBack("出生年月格式错误");
	}
	$CheckValue->checkReg("身份证",$_POST["card"],"/^[1-9](\d{16}|\d{13})[0-9xX]$/");
	$CheckValue->checkNull("学历",$_POST["education"]);
	$CheckValue->checkLen("学历",$_POST["education"],50);
	$CheckValue->checkNull("职务",$_POST["job"]);
	$CheckValue->checkLen("职务",$_POST["job"],50);
	$CheckValue->checkLen("职称",$_POST["title"],50);
	$CheckValue->checkLen("工作单位",$_POST["company"],100);
	$CheckValue->checkLen("区县",$_POST["county"],20);

	$CheckValue->checkLen("地址",$_POST["address"],100);
	$CheckValue->checkNull("手机号码",$_POST["phone"]);
	$CheckValue->checkReg("手机号码",$_POST["phone"],"/^1[3458]\d{9}$/");
	$CheckValue->checkLen("通讯地址",$_POST["address1"],100);
	if($_POST["zipcode"] != ""){
		$CheckValue->checkReg("邮编",$_POST["zipcode"],"/^\d{6}$/");
	}
	if($_POST["email"] != ""){
		$CheckValue->checkReg("邮箱",$_POST["email"],"/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/");
	}
	if(strtolower($_POST["code"])!=strtolower($_SESSION["userCode"])){
		alertAndBack("验证码错误");
	}
	$baomingData=new BaomingData();
	$baoming=new Baoming($_POST["major"],$_POST["realname"],$_POST["sex"],$_POST["birthday"],$_POST["card"],$_POST["education"],$_POST["job"],$_POST["title"],$_POST["company"],$_POST["county"],$_POST["address"],$_POST["phone"],$_POST["address1"],$_POST["zipcode"],$_POST["email"],date("Y-m-d H:i:s"));
	if($baomingData->add($baoming)){
		alertAndGo("操作成功，我们会尽快与您联系","index.php");
	}else{
		alertAndBack("操作失败");
	}
	
}
?>
</head>

<body>
<?php include("Head.php"); ?>
<div class="main">
	<div class="main-1">
		<?php
		$headId = 9;
		include("Head1.php");
		?>
		<Div class="main-2">
			<div class="right-da">
				<div class="right-top" style="width:100%;">
					<div class="right-biao">在线报名</div>
					<div class="home"><img src="images/home.gif" />&nbsp;&nbsp;您当前位置：网站首页 > 在线报名</div>
				</div>
				<div class="right-main-da">
					<form action="?act=ok" method="post" onsubmit="return checkForm(this)">
						<table width="78%" height="700" border="0" align="center">
						  <tr>
						    <td colspan="2" style="color:#2774a6;"><p>欢迎您登录在线报名栏目，您提交的报名内容我们会及时收到，查看核实信息后会和您取得联系！ "<span class="zi">*</span>"为必填项！</p>
					        <p>&nbsp;</p></td>
					      </tr>
						  <tr>
							<td align="right">所报专业类型：</td>
							<td>
							  <select name="major">
							  <option value="">请选择</option>
							  <?php
							  $majorArr = explode("|",$webSetting->majorType);
							  foreach($majorArr as $major){
							  ?>
							    
							    <option value="<?php echo($major);?>"><?php echo($major);?></option>
							  <?php
							  }
							  ?>
						            </select>
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">姓名：</td>
							<td>
							  <input type="text" name="realname" />
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">性别：</td>
							<td>
							  <input name="sex" type="radio" value="男" checked="checked" />
							男 
							<input type="radio" name="sex" value="女" />
							女<span class="zi"> *</span></td>
						  </tr>
						  <tr>
							<td align="right">出生年月：</td>
							<td><input type="text" name="birthday" class="text60" style="width:70px;" value="" readonly="true" onFocus="new Calendar().show(this)"><span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">身份证号：</td>
							<td>
							  <input type="text" name="card" />
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">学历：</td>
							<td>
							  <select name="education">
							    <option value="">请选择</option>
							    <option value="初中毕业">初中毕业</option>
							    <option value="高中毕业/中专毕业">高中毕业/中专毕业</option>
							    <option value="大专毕业/高职毕业">大专毕业/高职毕业</option>
							    <option value="本科毕业">本科毕业</option>
							    <option value="硕士">硕士</option>
							    <option value="博士">博士</option>
						      </select>
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">职务：</td>
							<td>
							  <input type="text" name="job" />
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">职称：</td>
							<td>
							  <input type="text" name="title" />
							</td>
						  </tr>
						  <tr>
							<td align="right">工作单位：</td>
							<td>
							  <input name="company" type="text" size="40" />
							</td>
						  </tr>
						  <tr>
							<td align="right">区县：</td>
							<td>
							  <select name="county">
							    <option value="">请选择</option>
							    <option value="城区">城区</option>
							    <option value="泽州县">泽州县</option>
							    <option value="阳城县">阳城县</option>
							    <option value="陵川县">陵川县</option>
							    <option value="沁水县">沁水县</option>
							    <option value="高平市">高平市</option>
						      </select>
							</td>
						  </tr>
						  <tr>
							<td align="right">地址：</td>
							<td>
							  <input name="address" type="text" size="40" />
							</td>
						  </tr>
						  <tr>
							<td align="right">联系电话：</td>
							<td>
							  <input type="text" name="phone" />
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">通讯地址：</td>
							<td>
							  <input name="address1" type="text" size="40" />
							</td>
						  </tr>
						  <tr>
							<td align="right">邮编：</td>
							<td>
							  <input type="text" name="zipcode" />
							</td>
						  </tr>
						  <tr>
							<td align="right">电子邮件：</td>
							<td>
							  <input type="text" name="email" />
							</td>
						  </tr>
						  <tr>
							<td align="right">验证码：</td>
							<td>
							  <table cellpadding="0" cellspacing="0" border="0"><tr><td><input name="code" type="text"  size="5"/></td><td valign="middle"><img width="100" height="30" src="Captcha.php?<?php echo(rand(0,999))?>" onClick="javascript:this.src=this.src+'?'+Math.random();" alt="看不清？点击图片更换下一张" style="margin-left:10px;" /><span style="color:#FF0000;">*</span></td></tr></table>
							</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><br />
						    <input type="image" src="images/tijiao.gif" width="136" height="49" /></td>
						  </tr>
						</table>
					</form>
				</div>
			</div>
		</Div>
	</div>
</div><br/>
<?php include("Bottom.php"); ?>
</body>
</html>
