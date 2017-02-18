<?php
class BaomingData{
	public $table = "tbl_baoming";
	function add($baoming){
		$sql="insert into {$this->table}(major,realname,sex,birthday,card,education,job,title,company,county,address,phone,address1,zipcode,email,addtime) values('".$baoming->major."','".$baoming->realname."','".$baoming->sex."','".$baoming->birthday."','".$baoming->card."','".$baoming->education."','".$baoming->job."','".$baoming->title."','".$baoming->company."','".$baoming->county."','".$baoming->address."','".$baoming->phone."','".$baoming->address1."','".$baoming->zipcode."','".$baoming->email."','".$baoming->addtime."')";
		return mysql_query($sql);
	}
	function delete($id){
		$sql="delete from {$this->table} where id in(".$id.")";
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
		$arrBaoming;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$baoming=new Baoming($a["major"],$a["realname"],$a["sex"],$a["birthday"],$a["card"],$a["education"],$a["job"],$a["title"],$a["company"],$a["county"],$a["address"],$a["phone"],$a["address1"],$a["zipcode"],$a["email"],$a["addtime"],$a["id"]);
			$arrBaoming[$i]=$baoming;
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrBaoming;
		return $arr;
	}
	function getInfoById($id){
		$sql="select * from {$this->table} where id=".$id;
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new Baoming($a["major"],$a["realname"],$a["sex"],$a["birthday"],$a["card"],$a["education"],$a["job"],$a["title"],$a["company"],$a["county"],$a["address"],$a["phone"],$a["address1"],$a["zipcode"],$a["email"],$a["addtime"],$a["id"]);
		}
		return $arr;
	}
}
?>