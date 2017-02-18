<?php
class AdData{
	function add($ad){
		$sql="insert into tbl_ad(link,image,sort) values('".$ad->link."','".$ad->image."',".$ad->sort.")";
		return mysql_query($sql);
	}
	function change($ad){
		$sql="update tbl_ad set link='".$ad->link."', image='".$ad->image."',sort=".$ad->sort." where id=".$ad->id;
		return mysql_query($sql);
	}
	function delete($id){
		$sql="delete from tbl_ad where id in(".$id.")";
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
		$arrAd;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$ad=new Ad($a["link"],$a["image"],$a["sort"],$a["id"]);
			$arrAd[$i]=$ad;
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrAd;
		return $arr;
	}
	function listAll(){
		$sql="select * from tbl_ad order by sort asc,id asc";
		$result=mysql_query($sql);
		$i=0;
		$arrAd;
		while($a=mysql_fetch_array($result)){
			$ad=new Ad($a["link"],$a["image"],$a["sort"],$a["id"]);
			$arrAd[$i]=$ad;
			$i+=1;
		}
		return $arrAd;
	}
	function getInfoById($id){
		$sql="select * from tbl_ad where id=".$id;
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new Ad($a["link"],$a["image"],$a["sort"],$a["id"]);
		}
		return $arr;
	}
}
?>