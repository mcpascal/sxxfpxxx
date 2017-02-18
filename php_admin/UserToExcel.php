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
 			->setCellValue( 'A1', '编号' )
            ->setCellValue( 'B1', '用户名' )         //给表的单元格设置数据
            ->setCellValue( 'C1', '电子邮件' )      //数据格式可以为字符串
            ->setCellValue( 'D1', '姓名')            //数字型
            ->setCellValue( 'E1', '性别') 
            ->setCellValue( 'F1', '生日')            //布尔型
            ->setCellValue( 'G1', '身份证' )//公式
            ->setCellValue( 'H1', '学历' )
            ->setCellValue( 'I1', '职务' )      
            ->setCellValue( 'J1', '职称') 
            ->setCellValue( 'K1', '工作单位') 
            ->setCellValue( 'L1', '区县') 
            ->setCellValue( 'M1', '地址') 
            ->setCellValue( 'N1', '联系电话') 
            ->setCellValue( 'O1', '通讯地址') 
            ->setCellValue( 'P1', '邮编')
            ->setCellValue( 'Q1', '提交时间');
            //->setCellValue( 'R1', '提交时间');


	//$page=new Page(0,0,$pageListNumber,$p);
	$sql="select * from [/table/] where 1=1 order by id";

	//echo $sql;
	
	$scoreData=new ScoreData();
	$messageData=new UserData();
	$arr=$messageData->fetchAllUser($sql);


	//var_dump($arr);die;
	for($i=0;$i<count($arr);$i++){
		
	
			$objPHPExcel->setActiveSheetIndex(0)             //设置第一个内置表（一个xls文件里可以有多个表）为活动的
            ->setCellValue( 'A'.($i+2), $arr[$i]->id)
            ->setCellValue( 'B'.($i+2), ' '.strval($arr[$i]->username))         //给表的单元格设置数据
            ->setCellValue( 'C'.($i+2), $arr[$i]->email)      //数据格式可以为字符串
            ->setCellValue( 'D'.($i+2), $arr[$i]->realname)            //数字型
            ->setCellValue( 'E'.($i+2), $arr[$i]->sex)           //布尔型
            ->setCellValue( 'F'.($i+2), $arr[$i]->birthday)//公式
            ->setCellValue( 'G'.($i+2), ' '.strval($arr[$i]->card))
            ->setCellValue( 'H'.($i+2), $arr[$i]->education)
            ->setCellValue( 'I'.($i+2), $arr[$i]->job)
            ->setCellValue( 'J'.($i+2), $arr[$i]->title)
            ->setCellValue( 'K'.($i+2), $arr[$i]->company)
            ->setCellValue( 'L'.($i+2), $arr[$i]->county)
            ->setCellValue( 'M'.($i+2), $arr[$i]->address)
            ->setCellValue( 'N'.($i+2), ' '.strval($arr[$i]->phone))
            ->setCellValue( 'O'.($i+2), $arr[$i]->address1)
            ->setCellValue( 'P'.($i+2), $arr[$i]->zipcode)
            ->setCellValue( 'Q'.($i+2), $arr[$i]->addtime);
            //->setCellValue( 'R'.($i+2), intval($arr[$i]->addtime));

	}




//得到当前活动的表,注意下文教程中会经常用到$objActSheet
$objActSheet = $objPHPExcel->getActiveSheet();
// 位置bbb  *为下文代码位置提供锚
// 给当前活动的表设置名称
$objActSheet->setTitle('user');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('user.xlsx');

if($fileType == 'xls'){
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="user.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
}elseif($fileType == 'xlsx'){
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="user.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
$objWriter->save( 'php://output');
exit;
}else{
	echo "hello";
}