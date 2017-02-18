<?php
include("../config.php");
include("../Base.php");
include(GI."/phpexcel/PHPExcel/IOFactory.php");
include(GI."../phpexcel/PHPExcel.php");
include(GI.'../phpexcel/PHPExcel/Reader/Excel5.php');
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/User.php");
//include(GI."/class/PhpExcel.php");
include(GI."/data/UserData.php");
include(GI."/class/Score.php");
include(GI."/data/ScoreData.php");
include(GI."/include/CheckValueNotAlert.php");
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
<script type="text/javascript">
String.prototype.trim=function() {
    return this.replace(/(^\s*)|(\s*$)/g,'');
}
function checkAdd(obj){
	var checkValue=new CheckValueNotAlert();
	if(!checkValue.checkReg("身份证号",obj.userName.value,/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/))return false;
	//if(!checkValue.checkReg("成绩",obj.newScore.value.trim(),/^(0|[1-9]\d|100)$/))return false;
}
</script>
</head>
<?php
$act=$_GET["act"];
if($act=="upload"){
	if (! empty ( $_FILES ['excel_file'] ['name'] ))
	{
		$tmp_file = $_FILES ['excel_file'] ['tmp_name'];
		$file_types = explode ( ".", $_FILES ['excel_file'] ['name'] );
		$file_type = $file_types [count ( $file_types ) - 1];
     /*判别是不是.xls文件，判别是不是excel文件*/
     if (strtolower ( $file_type ) != "xls" and strtolower ( $file_type ) != "xlsx")              
    {
        echo( '不是Excel文件，重新上传' );exit;
     }
    /*设置上传路径*/
     $savePath = '../uploadfile/excel/';
    /*以时间来命名上传的文件*/
     $str = date ( 'Ymdhis' ); 
     $file_name = $savePath.$str . "." . $file_type;
     /*是否上传成功*/
     if (! copy ( $tmp_file, $file_name )) 
      {
          echo( '上传失败' );exit; 
      }
	 //echo $file_name;
	 
	$objReader = PHPExcel_IOFactory::createReader('Excel5');
	$objPHPExcel = $objReader->load($file_name);
	$sheet = $objPHPExcel->getSheet(0);
	$highestRow = $sheet->getHighestRow();
	$highestColumn = $sheet->getHighestColumn();
	//echo $highestColumn;
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	for($row=2;$row<=$highestRow;$row++){
		for($col='A';$col<=$highestColumn;$col++){
			$excelData[$row][] = $objPHPExcel->getActiveSheet()->getCell("$col$row")->getValue();;
		}
	}
	//print_r($excelData);die;
	foreach($excelData as $key=>$value){

		$userData=new UserData();
		if($userData->checkUserNameExist($value["1"])){
			alertAndBack("用户名已存在");
		}
		if($userData->checkCardExist($value["card"])){
			alertAndBack("身份证已经被注册");
		}
		//$user=new User($_POST["username"],md5($_POST["pwd"]),$_POST["realname"],$_POST["sex"],$_POST["birthday"],$_POST["card"],$_POST["education"],$_POST["job"],$_POST["title"],$_POST["company"],$_POST["county"],$_POST["address"],$_POST["phone"],$_POST["address1"],$_POST["zipcode"],$_POST["email"],date("Y-m-d H:i:s"),1);
		$user=new User(trim($value["1"]),md5(trim($value["2"])),trim($value["4"]),$value["5"],$value["6"],strval(trim($value["7"])),$value["8"],$value["9"],$value["10"],$value["11"],$value["12"],$value["13"],trim($value["14"]),$value["15"],$value["16"],$value["3"],date("Y-m-d H:i:s"),1);

		$userData->add($user)?done(1,"UserManage.php"):done(0);

	}

   }
}
?>
<body>
<div class="title">
	<div class="title1">
		<div class="title1Left"><img src="images/smallimg/2.png" /></div>
		<div class="title1Center">会员批量录入</div>
	</div>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<form action="?act=upload" method="post" enctype="multipart/form-data" name="form1" onsubmit="return checkAdd(this);">
	<tr>
		<td width="15%" align="right" >导入会员Excel表：</td>
		<td align="left"><input type="file" class="file" name="excel_file"><span class="red"><a href="../usermb.xls">会员模板文件</a></span></td>
	</tr>
	
		<td></td>
		<td align="left"><input type="submit"   value="提交" class="button"></td>
	</tr>
	</form>
</table>
</body>
</html>
