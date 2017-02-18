<?php
class RecruitmentData {
	function add($recuritment){
		$sql="insert into tbl_recruitment(title,money,num,education,nature,description,sort) 
			values('".$recuritment->title."','".$recuritment->money."','".$recuritment->num."','".$recuritment->education."','".$recuritment->nature."','".$recuritment->description."',".$recuritment->sort.")";
		//echo $sql;
		return mysql_query($sql);
	}
	function change($recuritment){
		$sql="update tbl_recruitment 
			set title='".$recuritment->title."',money='".$recuritment->money."',num='".$recuritment->num."',education='".$recuritment->education."',nature='".$recuritment->nature."',description='".$recuritment->description."',sort=".$recuritment->sort.
			" where id=".$recuritment->id;
		//echo $sql;
		return mysql_query($sql);
	}
	function delete($id){
		$sql="delete from tbl_recruitment where id in(".$id.")";
		return mysql_query($sql);
	} 
	function listAll(){
		$arr;
		$sql="select * from tbl_recruitment order by id asc";
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$arr[$i]=new Recruitment($a["title"],$a["money"],$a["num"],$a["education"],$a["nature"],$a["description"],$a["sort"],$a["id"]);
			$i+=1;
		}
		return $arr;
	}
	function listNumber($number){
		$arr;
		$sql="select * from tbl_recruitment order by indexSort asc,id desc limit ".$number;
		$result=mysql_query($sql,$connect->con);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$arr[$i]=new Recruitment($a["title"],$a["money"],$a["num"],$a["education"],$a["nature"],$a["description"],$a["sort"],$a["id"]);
			$i+=1;
		}
		return $arr;
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
		$arrT;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$arrT[$i]=new Recruitment($a["title"],$a["money"],$a["num"],$a["education"],$a["nature"],$a["description"],$a["sort"],$a["id"]);
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrT;
		return $arr;
	}
	function getInfoById($id){
		$sql="select * from tbl_recruitment where id=".$id;
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new Recruitment($a["title"],$a["money"],$a["num"],$a["education"],$a["nature"],$a["description"],$a["sort"],$a["id"]);
		}
		return $arr;
	}
}

?>