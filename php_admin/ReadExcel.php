<?php 
header("Content-Type:text/html;charset=utf-8");
require_once("../phpexcel/PHPExcel.php");
require_once '../phpexcel/PHPExcel/IOFactory.php';
require_once '../phpexcel/PHPExcel/Reader/Excel5.php';
include("../config.php");
include("../Base.php");
include(GI."/include/Header.php");
include(GI."/include/function.php");
include(GI."/class/User.php");
include(GI."/data/UserData.php");
include(GI."/class/Score.php");
include(GI."/data/ScoreData.php");
include(GI."/include/CheckValueNotAlert.php");
include(GI."/include/CheckLoginForAdmin.php");

$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load('mb.xls');
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();

for($j=2;$j<$highestRow;$j++){
	for($k='A';$k<=$highestColumn;$k++){
		$value[] =$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
	}
	$data[$i] = $value;
}
//var_dump($data);

foreach($data as $key=>$value){
	print_r($value);
	//echo $value[1];
	$CheckValueNotAlert=new CheckValueNotAlert();
	$CheckValueNotAlert->checkReg("身份证号",$value[1],"/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/");
	$CheckValueNotAlert->checkReg("成绩",intval($value[2]),"/^(0|[1-9]\d|100)$/");
	$scoreData=new ScoreData();
	$messageData=new UserData();
	
	$a = $messageData->getInfoByUserNameOrCard($value[1]);
	echo $value[1];
	var_dump($a);
	$user = $a[1];	
	print_r($user);
	$classname=$value[3];
	//echo $classname;
	$username=$user->username;
	//echo $username;
	$newScore=$value[2];
	//echo $newScore;
	$addtime=date("Y-m-d H:i",time());
	//echo $addtime;
	$id=$user->id;
	echo $id;
	$score=new Score($classname, $username, $newScore, $addtime, $id);
	
	//echo "hello";
	$scoreData->add($score)?done(1,"ScoreManage.php"):done(0);
}


?>