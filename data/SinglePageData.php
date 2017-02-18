<?php
class SinglePageData{
	function add($singlePage){
		$sql="insert into tbl_singlePage(singlePageClassId,title,content,sort) values(".$singlePage->singlePageClassId.",'".$singlePage->title."','".$singlePage->content."',".$singlePage->sort.")";
		return mysql_query($sql);
	}
	function change($singlePage){
		$sql="update tbl_singlePage set singlePageClassId=".$singlePage->singlePageClassId.", title='".$singlePage->title."',content='".$singlePage->content."',sort=".$singlePage->sort." where id=".$singlePage->id;
		return mysql_query($sql);
	}
	function delete($id){
		$sql="delete from tbl_singlePage where id in(".$id.")";
		return mysql_query($sql);
	}
	function deleteBySinglePageClassId($id){
		$sql="delete from tbl_singlePage where singlePageClassId in(".$id.")";
		return mysql_query($sql);
	}
	function listAll(){
		$arrSinglePage;
		$sql="select * from tbl_singlePage order by id asc";
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$singlePage=new SinglePage($a["singlePageClassId"],$a["title"],$a["content"],$a["sort"],$a["id"]);
			$arrSinglePage[$i]=$singlePage;
			$i+=1;
		}
		return $arrSinglePage;
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
		$arrSinglePage;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$singlePage=new SinglePage($a["singlePageClassId"],$a["title"],$a["content"],$a["sort"],$a["id"]);
			$arrSinglePage[$i]=$singlePage;
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrSinglePage;
		return $arr;
	}
	function listAllBySinglePageClassId($singlePageClassId){
		$arrSinglePage;
		$sql="select * from tbl_singlePage where singlePageClassId=".$singlePageClassId." order by id asc";
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$singlePage=new SinglePage($a["singlePageClassId"],$a["title"],$a["content"],$a["sort"],$a["id"]);
			$arrSinglePage[$i]=$singlePage;
			$i+=1;
		}
		return $arrSinglePage;
	}
	function getInfoById($id){
		$sql="select * from tbl_singlePage where id=".$id;
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new SinglePage($a["singlePageClassId"],$a["title"],$a["content"],$a["sort"],$a["id"]);
		}
		return $arr;
	}
	function getInfoBySql($sql){
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new SinglePage($a["singlePageClassId"],$a["title"],$a["content"],$a["sort"],$a["id"]);
		}
		return $arr;
	}
}
?>