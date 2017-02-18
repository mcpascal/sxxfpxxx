<?php
class UserData{
	public $table = "tbl_user";
	function add($user){
		$sql="insert into {$this->table}(username,pwd,realname,sex,birthday,card,education,job,title,company,county,address,phone,address1,zipcode,email,addtime,state) values('".$user->username."','".$user->pwd."','".$user->realname."','".$user->sex."','".$user->birthday."','".$user->card."','".$user->education."','".$user->job."','".$user->title."','".$user->company."','".$user->county."','".$user->address."','".$user->phone."','".$user->address1."','".$user->zipcode."','".$user->email."','".$user->addtime."',".$user->state.")";
		//echo $sql;
		return mysql_query($sql);
	}
	function checkUserNameExist($userName){
		$sql = "select * from {$this->table} where username='{$userName}'";
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			return true;
		}else{
			return false;
		}
	}
	function checkCardExist($card){
		$sql = "select * from {$this->table} where card='{$card}'";
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			return true;
		}else{
			return false;
		}
	}
	function change($user){
		$sql="update {$this->table} set username=".$user->username.", pwd='".$user->pwd."',realname='".$user->realname."',sex='".$user->sex."',birthday='".$user->birthday."',card='".$user->card."',education='".$user->education."',job='".$user->job."',title='".$user->title."',company='".$user->company."',county='".$user->county."',address='".$user->address."',phone='".$user->phone."',address1='".$user->address1."',zipcode='".$user->zipcode."',email='".$user->email."',addtime='".$user->addtime."',state=".$user->state." where id=".$user->id;
		return mysql_query($sql);
	}
	function delete($id){
		$sql="delete from {$this->table} where id in(".$id.")";
		//echo $sql;
		return mysql_query($sql);
	}
	function listBySql($sql,$page){
		$sql = str_replace("[/table/]", $this->table, $sql);
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
		$arrNews;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$user=new User($a["username"],$a["pwd"],$a["realname"],$a["sex"],$a["birthday"],$a["card"],$a["education"],$a["job"],$a["title"],$a["company"],$a["county"],$a["address"],$a["phone"],$a["address1"],$a["zipcode"],$a["email"],$a["addtime"],$a["state"],$a["id"]);
			$arrNews[$i]=$user;
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrNews;
		return $arr;
	}
	function fetchAllUser($sql){
		$sql = str_replace("[/table/]", $this->table, $sql);
		$arrNews;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$user=new User($a["username"],$a["pwd"],$a["realname"],$a["sex"],$a["birthday"],$a["card"],$a["education"],$a["job"],$a["title"],$a["company"],$a["county"],$a["address"],$a["phone"],$a["address1"],$a["zipcode"],$a["email"],$a["addtime"],$a["state"],$a["id"]);
			$arrNews[$i]=$user;
			$i+=1;
		}
		$arr=$arrNews;
		return $arr;
	}
	function getInfoById($id){
		$sql="select * from {$this->table} where id=".$id;
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new User($a["username"],$a["pwd"],$a["realname"],$a["sex"],$a["birthday"],$a["card"],$a["education"],$a["job"],$a["title"],$a["company"],$a["county"],$a["address"],$a["phone"],$a["address1"],$a["zipcode"],$a["email"],$a["addtime"],$a["state"],$a["id"]);
		}
		return $arr;
	}
	
	function getInfoByUserNameOrCard($key){
		$sql="select * from {$this->table} where username='{$key}' or card='{$key}'";
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new User($a["username"],$a["pwd"],$a["realname"],$a["sex"],$a["birthday"],$a["card"],$a["education"],$a["job"],$a["title"],$a["company"],$a["county"],$a["address"],$a["phone"],$a["address1"],$a["zipcode"],$a["email"],$a["addtime"],$a["state"],$a["id"]);
		}
		return $arr;
	}
	
	function login($userName, $pwd){
		$sql = "select * from {$this->table} where username='{$userName}' and pwd='{$pwd}' and state=1";
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new User($a["username"],$a["pwd"],$a["realname"],$a["sex"],$a["birthday"],$a["card"],$a["education"],$a["job"],$a["title"],$a["company"],$a["county"],$a["address"],$a["phone"],$a["address1"],$a["zipcode"],$a["email"],$a["addtime"],$a["state"],$a["id"]);
		}
		return $arr;
	}
}
?>