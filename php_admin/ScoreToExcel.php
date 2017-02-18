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
$fileType = 'xlsx';
//首先创建一个新的对象
$objPHPExcel = new PHPExcel();

//设置文件的一些属性
$objPHPExcel -> getProperties()
			 -> setCreator('Pascal Yu')
			 -> setLastModifiedBy('Pascal Yu')
			 ->	setTitle('Office 2007 XLSX Test Document')
			 ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
     		 ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
     		 ->setKeywords( "office 2007 openxml php")        //设置标记
     		 ->setCategory( "Test result file");                //设置类别




 $objPHPExcel->setActiveSheetIndex(0)             //设置第一个内置表（一个xls文件里可以有多个表）为活动的
            ->setCellValue( 'A1', '编号' )         //给表的单元格设置数据
            ->setCellValue( 'B1', '类别' )      //数据格式可以为字符串
            ->setCellValue( 'C1', '用户名')            //数字型
            ->setCellValue( 'D1', '姓名')           //布尔型
            ->setCellValue( 'E1', '身份证' )//公式
            ->setCellValue( 'F1', '成绩' )
            ->setCellValue( 'G1', '考试时间' );




	//$page=new Page(0,0,$pageListNumber,$p);
	$sql="select * from [/table/] where username in(select username from tbl_user where 1=1) order by id";

	//echo $sql;
	
	$scoreData=new ScoreData();

	$messageData=new UserData();
	$arr=$scoreData->fetchAllScore($sql);


	//var_dump($arr);die;
	for($i=0;$i<count($arr);$i++){
		$a = $messageData->getInfoByUserNameOrCard($arr[$i]->username);
		$user = $a[1];
	
			$objPHPExcel->setActiveSheetIndex(0)             //设置第一个内置表（一个xls文件里可以有多个表）为活动的
            ->setCellValue( 'A'.($i+2), $arr[$i]->id)         //给表的单元格设置数据
            ->setCellValue( 'B'.($i+2), ' '.strval($arr[$i]->classname))      //数据格式可以为字符串
            ->setCellValue( 'C'.($i+2), ' '.strval($arr[$i]->username))            //数字型
            ->setCellValue( 'D'.($i+2), ' '.strval($user->realname))           //布尔型
            ->setCellValue( 'E'.($i+2), ' '.strval($user->card))//公式
            ->setCellValue( 'F'.($i+2), intval($arr[$i]->score))
            ->setCellValue( 'G'.($i+2), $arr[$i]->addtime);

	}




//得到当前活动的表,注意下文教程中会经常用到$objActSheet
$objActSheet = $objPHPExcel->getActiveSheet();
// 位置bbb  *为下文代码位置提供锚
// 给当前活动的表设置名称
$objActSheet->setTitle('Simple2222');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('myexchel.xlsx');

if($fileType == 'xls'){
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
}elseif($fileType == 'xlsx'){
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
$objWriter->save( 'php://output');
exit;
}else{
	echo "hello";
}