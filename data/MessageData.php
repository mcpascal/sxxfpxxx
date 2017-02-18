<?php
class MessageData{
	function add($message){
		$sql="insert into tbl_message(personName,phone,email,title,content,addTime) values('".$message->personName."','".$message->phone."','".$message->email."','".$message->title."','".$message->content."','".$message->addTime."')";
		return mysql_query($sql);
	}
	function delete($id){
		$sql="delete from tbl_message where id=".(int)$id;
		return mysql_query($sql);
	}
	function listAll(){
		$arrMessage;
		$sql="select * from tbl_message order by id asc";
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$message=new Message($a["personName"],$a["phone"],$a["email"],$a["title"],$a["content"],$a["addTime"],$a["id"]);
			$arrMessage[$i]=$message;
			$i+=1;
		}
		return $arrMessage;
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
		$arrMessage;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$message=new Message($a["personName"],$a["phone"],$a["email"],$a["title"],$a["content"],$a["addTime"],$a["id"]);
			$arrMessage[$i]=$message;
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrMessage;
		return $arr;
	}
	function selectTopOne(){
		$message;
		$sql="select * from tbl_message order by sort asc, id asc limit 1";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)>0){
			$a=mysql_fetch_array($result);
			$message=new Message($a["name"],$a["sort"],$a["id"]);
		}else{
			$message=new Message();
		}
		return $message;
	}
	function getInfoById($id){
		$message;
		$sql="select * from tbl_message where id=".$id." order by sort asc, id asc limit 1";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)>0){
			$a=mysql_fetch_array($result);
			$message=new Message($a["personName"],$a["phone"],$a["email"],$a["title"],$a["content"],$a["addTime"],$a["id"]);
		}else{
			$message=new Message();
		}
		return $message;
	}
}
?>