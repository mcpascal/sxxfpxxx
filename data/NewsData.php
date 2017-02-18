<?php
class NewsData{
	function add($news){
		$sql="insert into tbl_news(newsClassId,title,image,content,indexSort,classSort,addTime) values(".$news->newsClassId.",'".$news->title."','".$news->image."','".$news->content."',".$news->indexSort.",".$news->classSort.",'".$news->addTime."')";
		return mysql_query($sql);
	}
	function change($news){
		$sql="update tbl_news set newsClassId=".$news->newsClassId.", title='".$news->title."',image='".$news->image."',content='".$news->content."',indexSort=".$news->indexSort.",classSort=".$news->classSort.",addTime='".$news->addTime."' where id=".$news->id;
		return mysql_query($sql);
	}
	function delete($id){
		$sql="delete from tbl_news where id in(".$id.")";
		return mysql_query($sql);
	}
	function deleteByNewsClassId($id){
		$sql="delete from tbl_news where newsClassId in(".$id.")";
		return mysql_query($sql);
	}
	function listAll(){
		$arrNews;
		$sql="select * from tbl_news order by id asc";
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$news=new News($a["newsClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
			$arrNews[$i]=$news;
			$i+=1;
		}
		return $arrNews;
	}
	function listNumber($number){
		$arrNews;
		$sql="select * from tbl_news order by indexSort asc,id desc limit ".$number;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$news=new News($a["newsClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
			$arrNews[$i]=$news;
			$i+=1;
		}
		return $arrNews;
	}
	function listNumberInClass($number,$classIds,$image=0){
		$arrNews;
		if($image==0){
			$sql="select * from tbl_news where newsClassId in($classIds) order by indexSort asc,id desc limit ".$number;
		}else{
			$sql="select * from tbl_news where newsClassId in($classIds) and image!='' order by indexSort asc,id desc limit ".$number;
		}
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$news=new News($a["newsClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
			$arrNews[$i]=$news;
			$i+=1;
		}
		return $arrNews;
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
		$arrNews;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$news=new News($a["newsClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
			$arrNews[$i]=$news;
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrNews;
		return $arr;
	}
	function listAllByNewsClassId($newsClassId){
		$arrNews;
		$sql="select * from tbl_news where newsClassId=".$newsClassId." order by id asc";
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$news=new News($a["newsClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
			$arrNews[$i]=$news;
			$i+=1;
		}
		return $arrNews;
	}
	function getInfoById($id){
		$sql="select * from tbl_news where id=".$id;
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new News($a["newsClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
		}
		return $arr;
	}
	
	function getUpOrNextOne($id,$classId,$type){
		$sql="select * from tbl_news where id<$id and newsClassId=$classId order by id desc limit 1";
		if($type=="next"){
			$sql="select * from tbl_news where id>$id and newsClassId=$classId order by id asc limit 1";
		}
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new News($a["newsClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
		}
		return $arr;
	}
}
?>