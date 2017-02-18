<?php

function alert($str){
	die("<script type='text/javascript'>alert('".$str."');</script>");
}
function alertAndBack($str){
	die("<script type='text/javascript'>alert('".$str."');window.history.back();</script>");
}
function alertAndGo($str,$url){
	die("<script type='text/javascript'>alert('".$str."');window.location.href='".$url."';</script>");
}
function alertAndTopGo($str,$url){
	die("<script type='text/javascript'>alert('".$str."');window.top.location.href='".$url."';</script>");
}
function gotoTop($url){
	die("<script type='text/javascript'>window.top.location.href='".$url."';</script>");
}
/*
function gotoUrl($url){
	die("<script type='text/javascript'>window.location.href='".$url."';</script>");
}
*/
function gotoUrl($url){
	die("<script type='text/javascript'>window.location.href='".$url."';</script>");
}
function done($type, $url="", $rightResult="", $errorResult=""){
	$str="";
	$type==1?$str="window.top.win3.win3Show(1,\"操作成功\",\"\");":$str="window.top.win3.win3Show(0,\"操作失败\",\"\");";
	if($type == 1 && $rightResult != ""){
		$str = "window.top.win3.win3Show(1,\"" . $rightResult . "\",\"\");";
	}
	if($type == 0 && $errorResult != ""){
		$str = "window.top.win3.win3Show(0,\"" . $errorResult . "\",\"\");";
	}
	$url==""?$str.="window.history.back();":$str.="window.location.href='".$url."';";
	echo("<script type='text/javascript'>".$str."</script>");
}
function cutStr($string, $length) {
		$string=ClearHtml($string);
		
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $info);  
		$wordscut="";
		$j=0;
		for($i=0; $i<count($info[0]); $i++) {
				
                $wordscut .= $info[0][$i];
				
                $j = ord($info[0][$i]) > 127 ? $j + 2 : $j + 1;
                if ($j > $length - 3) {
                        return $wordscut." ...";
                }
        }
        return join('', $info[0]);
}
function clearHtml($content){
	$content = strip_tags($content);     
	$content = preg_replace("/<a[^>]*>/i", "", $content);     
	$content = preg_replace("/<\/a>/i", "", $content);      
	$content = preg_replace("/<div[^>]*>/i", "", $content);     
	$content = preg_replace("/<\/div>/i", "", $content);         
	$content = preg_replace("/<!--[^>]*-->/i", "", $content);//ע     
	$content = preg_replace("/style=.+?['|\"]/i",'',$content);//ȥʽ     
	$content = preg_replace("/class=.+?['|\"]/i",'',$content);//ȥʽ     
	$content = preg_replace("/id=.+?['|\"]/i",'',$content);//ȥʽ        
	$content = preg_replace("/lang=.+?['|\"]/i",'',$content);//ȥʽ         
	$content = preg_replace("/width=.+?['|\"]/i",'',$content);//ȥʽ      
	$content = preg_replace("/height=.+?['|\"]/i",'',$content);//ȥʽ      
	$content = preg_replace("/border=.+?['|\"]/i",'',$content);//ȥʽ      
	$content = preg_replace("/face=.+?['|\"]/i",'',$content);//ȥʽ      
	$content = preg_replace("/face=.+?['|\"]/",'',$content);//ȥʽ ֻСд ƥûд i    
	$content = preg_replace("/\s/",'',$content);//ȥʽ ֻСд ƥûд i    
	$content=str_replace(" ","",$content);
	$content=str_replace("&nbsp;","",$content);
	return $content; 
}
function getIP(){
    $realip="";
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
     if(trim($realip)=="::1"){  
        $ip="127.0.0.1";  
    }  
    return $realip;
}
function getOrderId(){
	$tempDate=date("Y-m-d H:i:s");
	$orderId=str_replace("-","",$tempDate);
	$orderId=str_replace(" ","",$orderId);
	$orderId=str_replace(":","",$orderId);
	
	$rand=rand(100000,999999);
	$orderId.=(string)$rand;
	return $orderId;
}
function getUserNumber(){
	return (string)rand(10000000,99999999);
}


function isDate($str,$format="Y-m-d"){
	$strArr = explode("-",$str);
	if(empty($strArr)){
		return false;
	}
	foreach($strArr as $val){
		if(strlen($val)<2){
			$val="0".$val;
		}
		$newArr[]=$val;
	}
	$str =implode("-",$newArr);
	$unixTime=strtotime($str);
	$checkDate= date($format,$unixTime);
	if($checkDate==$str){
		return true;
	}else{
		return false;
	}
}
?>