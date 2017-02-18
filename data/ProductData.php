<?php
class ProductData{
	function add($product){
		$sql="insert into tbl_product(productClassId,title,image,content,indexSort,classSort,addTime) values(".$product->productClassId.",'".$product->title."','".$product->image."','".$product->content."',".$product->indexSort.",".$product->classSort.",'".$product->addTime."')";
		return mysql_query($sql);
	}
	function change($product){
		$sql="update tbl_product set productClassId=".$product->productClassId.", title='".$product->title."',image='".$product->image."',content='".$product->content."',indexSort=".$product->indexSort.",classSort=".$product->classSort.",addTime='".$product->addTime."' where id=".$product->id;
		return mysql_query($sql);
	}
	function delete($id){
		$sql="delete from tbl_product where id in(".$id.")";
		return mysql_query($sql);
	}
	function deleteByProductClassId($id){
		$sql="delete from tbl_product where productClassId in(".$id.")";
		return mysql_query($sql);
	}
	function listAll(){
		$arrProduct;
		$sql="select * from tbl_product order by id asc";
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$product=new Product($a["productClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
			$arrProduct[$i]=$product;
			$i+=1;
		}
		return $arrProduct;
	}
	function listNumber($number){
		$arrProduct;
		$sql="select * from tbl_product order by indexSort asc,id desc limit ".$number;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$product=new Product($a["productClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
			$arrProduct[$i]=$product;
			$i+=1;
		}
		return $arrProduct;
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
		$arrProduct;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$product=new Product($a["productClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
			$arrProduct[$i]=$product;
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrProduct;
		return $arr;
	}
	function listAllByProductClassId($productClassId){
		$arrProduct;
		$sql="select * from tbl_product where productClassId=".$productClassId." order by indexSort asc,classSort asc, id desc";
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$product=new Product($a["productClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
			$arrProduct[$i]=$product;
			$i+=1;
		}
		return $arrProduct;
	}
	function getInfoById($id){
		$sql="select * from tbl_product where id=".$id;
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new Product($a["productClassId"],$a["title"],$a["image"],$a["content"],$a["indexSort"],$a["classSort"],$a["addTime"],$a["id"]);
		}
		return $arr;
	}
}
?>