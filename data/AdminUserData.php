<?php
class AdminUserData{
	function add($adminUser){
		$sql="insert into tbl_adminUser(userName,password,power) values('".$adminUser->userName."','".$adminUser->password."','".$adminUser->power."')";
		return mysql_query($sql);
	}
	function change($adminUser,$ifChagePassword){
		$sql="update tbl_adminUser set power='".$adminUser->power."'";
		if($ifChagePassword){
			$sql.=",password='".$adminUser->password."'";
		}
		$sql.=" where id=".$adminUser->id;
		return mysql_query($sql);
	}
	function delete($id){
		$sql="delete from tbl_adminUser where id in(".$id.")";
		return mysql_query($sql);
	}
	function listAll(){
		$arrAdminUser;
		$sql="select * from tbl_adminUser order by id asc";
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$adminUser=new AdminUser($a["userName"],$a["password"],$a["power"],$a["id"]);
			$arrAdminUser[$i]=$adminUser;
			$i+=1;
		}
		return $arrAdminUser;
	}
	function login($adminUser,$loginIp,$loginTime){
		$sql="select * from tbl_adminUser where userName='".$adminUser->userName."' and password='".$adminUser->password."'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			$arr=mysqli_fetch_array($result);
			$adminUser->userName=$arr["userName"];
			$adminUser->password=$arr["password"];
			$adminUser->id=$arr["id"];
			$adminUserLoginLog=new AdminUserLoginLog($adminUser->userName,$loginIp,$loginTime);
			$adminUserLoginLogData=new AdminUserLoginLogData();
			if(!$adminUserLoginLogData->insert($adminUserLoginLog)){
				$adminUser->userName="";
			}
		}else{
			$adminUser->userName="";
		}
		return $adminUser;
	}
	function getInfoByUserName($userName){
		$sql="select * from tbl_adminUser where userName='".$userName."'";
		$result=mysqli_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new AdminUser($a["userName"],$a["password"],$a["power"],$a["id"]);
		}
		return $arr;
	}
	function getInfoById($id){
		$sql="select * from tbl_adminUser where id=".$id;
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new AdminUser($a["userName"],$a["password"],$a["power"],$a["id"]);
		}
		return $arr;
	}
	
}
?>