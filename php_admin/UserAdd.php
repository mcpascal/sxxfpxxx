<?php
include("../config.php");
include("../Base.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/User.php");
include(GI."/data/UserData.php");
include(GI."/class/Score.php");
include(GI."/data/ScoreData.php");
include(GI."/include/CheckValueNotAlert.php");
include(GI."/include/CheckValue.php");
include(GI."/include/CheckLoginForAdmin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/Function.js"></script>
<script type="text/javascript" src="js/Right.js"></script>
<script type="text/javascript" src="js/CheckValueNotAlert.js"></script>
<script type="text/javascript" src="js/Admin.js"></script>

<script type="text/javascript" src="js/Date.js"></script>
<script type="text/javascript" src="../js/CheckValue.js"></script>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function checkForm(obj){
	var checkValue=new CheckValue();
	if(checkValue.checkNull(obj.username.value,"请填写用户名"))return false;
	if(!checkValue.checkReg(obj.username.value,/^[a-z0-9A-Z]{6,20}$/,"用户名格式错误"))return false;
	if(checkValue.checkNull(obj.pwd.value,"请填写密码"))return false;
	if(!checkValue.checkReg(obj.pwd.value,/^[a-z0-9A-Z]{6,20}$/,"密码格式错误"))return false;
	if(!checkValue.checkEqual(obj.pwd.value,obj.pwd1.value,"两次密码输入不一致"))return false;
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
}
</script>
<?php
$act=$_GET["act"];
if($act=="ok"){
	$CheckValue=new CheckValue();
	$CheckValue->checkNull("用户名",$_POST["username"]);
	$CheckValue->checkReg("用户名",$_POST["username"],"/^[a-z0-9A-Z]{6,20}$/");
	$CheckValue->checkNull("密码",$_POST["pwd"]);
	$CheckValue->checkReg("密码",$_POST["pwd"],"/^[a-z0-9A-Z]{6,20}$/");
	$CheckValue->checkNull("姓名",$_POST["realname"]);
	$CheckValue->checkLen("姓名",$_POST["realname"],20);
	if($_POST["sex"] != "男" && $_POST["sex"] != "女"){
		alertAndBack("性别错误");
	}
	$CheckValue->checkReg("出生年月",$_POST["birthday"],"/^\d{4}\-\d{2}\-\d{2}$/");
	if(!isDate($_POST["birthday"])){
		alertAndBack("出生年月格式错误");
	}
	$CheckValue->checkNull("身份证",$_POST["card"]);
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
	
	$userData=new UserData();
	if($userData->checkUserNameExist($_POST["username"])){
		alertAndBack("用户名已存在");
	}
	if($userData->checkCardExist($_POST["card"])){
		alertAndBack("身份证已经被注册");
	}
	$user=new User($_POST["username"],md5($_POST["pwd"]),$_POST["realname"],$_POST["sex"],$_POST["birthday"],$_POST["card"],$_POST["education"],$_POST["job"],$_POST["title"],$_POST["company"],$_POST["county"],$_POST["address"],$_POST["phone"],$_POST["address1"],$_POST["zipcode"],$_POST["email"],date("Y-m-d H:i:s"),1);
	if($userData->add($user)){
		alertAndGo("注册成功","UserManage.php");
	}else{
		alertAndBack("操作失败");
	}
	
}
?>
<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">会员录入</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<form action="?act=ok" method="post" onsubmit="return checkForm(this)">
						
						  <tr>
						    <td colspan="2" style="color:#2774a6;"><p>欢迎您注册安科职业培训学校会员，请您仔细填写以下信息，以便正确查询您的考试成绩，如填写有误请联系管理员进行核实！ "<span class="zi">*</span>"为必填项！</p>				            </td>
					      </tr>
						  
						  <tr>
							<td align="right">用户名：</td>
							<td align="left">
							  <input type="text" name="username" />
							  <span class="zi">*</span> 6~20字母数字组合</td>
						  </tr>
						  <tr>
							<td align="right">密码：</td>
							<td align="left">
							  <input type="password" name="pwd" />
							  <span class="zi">*</span> 6~20字母数字组合</td>
						  </tr>
						  <tr>
							<td align="right">重复密码：</td>
							<td align="left">
							  <input type="password" name="pwd1" />
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">姓名：</td>
							<td align="left">
							  <input type="text" name="realname" />
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">性别：</td>
							<td align="left">
							  <input name="sex" type="radio" value="男" checked="checked" />
							男 
							<input type="radio" name="sex" value="女" />
							女<span class="zi"> *</span></td>
						  </tr>
						  <tr>
							<td align="right">出生年月：</td>
							<td align="left"><input type="text" name="birthday" class="text60" style="width:70px;" value="" readonly="true" onFocus="new Calendar(1950, 2050).show(this)"><span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">身份证号：</td>
							<td align="left">
							  <input type="text" name="card" />
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">学历：</td>
							<td align="left">
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
							<td align="left">
							  <input type="text" name="job" />
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">职称：</td>
							<td align="left">
							  <input type="text" name="title" />
							</td>
						  </tr>
						  <tr>
							<td align="right">工作单位：</td>
							<td align="left">
							  <input name="company" type="text" size="40" />
							</td>
						  </tr>
						  <tr>
							<td align="right">区县：</td>
							<td align="left">
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
							<td align="left">
							  <input name="address" type="text" size="40" />
							</td>
						  </tr>
						  <tr>
							<td align="right">联系电话(手机号)：</td>
							<td align="left">
							  <input type="text" name="phone" />
							  <span class="zi">*</span></td>
						  </tr>
						  <tr>
							<td align="right">通讯地址：</td>
							<td align="left">
							  <input name="address1" type="text" size="40" />
							</td>
						  </tr>
						  <tr>
							<td align="right">邮编：</td>
							<td align="left">
							  <input type="text" name="zipcode" />
							</td>
						  </tr>
						  <tr>
							<td align="right">电子邮件：</td>
							<td align="left">
							  <input type="text" name="email" />
							</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><br />
						    <input type="image" src="../images/zhuce.gif" width="136" height="49" /></td>
						  </tr>
						
					</form>


</table>
</body>
</html>
