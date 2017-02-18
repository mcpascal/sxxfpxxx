<?php
class AdminUserLoginLogData{
	function insert($adminUserLoginLog){
		$sql="insert into tbl_adminUserLoginLog(userName,loginIp,loginTime) values('".$adminUserLoginLog->userName."','".$adminUserLoginLog->loginIp."','".$adminUserLoginLog->loginTime."')";
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
	function delete($id){
		$sql="delete from tbl_adminUserLoginLog where id in(".$id.")";
		return mysql_query($sql);
	}
	function listBySql($sql,$page){
		$result=mysql_query($sql);
		$num=mysql_num_rows($result);
		$pageNumber=(int)($num/$page->pageListNumber);
		if($num%$page->pageListNumber>0){
			$pageNumber+=1;
		}
		$page->pageNumber=$pageNumber;
		$page->allNumber=$num;
		is_numeric($page->currentPage)?$page->currentPage=(int)$page->currentPage:$page->currentPage=1;
		if($page->currentPage<1||$page->currentPage>$pageNumber){
			$page->currentPage=1;
		}
		
		$arrReview;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$arrReview[$i]=new AdminUserLoginLog($a["userName"],$a["loginIp"],$a["loginTime"],$a["id"]);
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrReview;
		return $arr;
	}
	function listByAdminUser($adminUser,$num){
		$sql="select * from tbl_adminUserLoginLog where userName='".$adminUser->userName."' order by id desc limit ".$num;
		$arrAdminUserLoginLog;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$arrAdminUserLoginLog[$i]=new AdminUserLoginLog($a["userName"],$a["loginIp"],$a["loginTime"],$a["id"]);
			$i+=1;
		}
		return $arrAdminUserLoginLog;
	}
}
?>