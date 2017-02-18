<?php
class ProductClassData{
	var $arrAll;
	var $i=0;
	var $idStr="";
	function add($productClass){
		$sql="insert into tbl_productClass(name,upClassId,firstClassId,path,grade,sort) values('".$productClass->name."',".$productClass->upClassId.",".$productClass->firstClassId.",'".$productClass->path."',".$productClass->grade.",".$productClass->sort.")";
		return mysql_query($sql);
	}
	function addByUpClassId($upClassId,$productClass){
		$returnValue=false;
		$sql="select * from tbl_productClass where id=".$upClassId;
		$result=mysql_query($sql);
		if(mysql_num_rows($result)==0){
			$returnValue=false;
		}else{
			$a=mysql_fetch_array($result);
			$upProductClass=new ProductClass($a["name"],$a["upClassId"],$a["firstClassId"],$a["path"],$a["grade"],$a["sort"],$a["id"]);
			$sql="insert into tbl_productClass(name,upClassId,firstClassId,path,grade,sort) values('".$productClass->name."',".$upProductClass->id.",".$upProductClass->firstClassId.",'".$upProductClass->path.",".(string)$upProductClass->id."',".($upProductClass->grade+1).",".$productClass->sort.")";
			$returnValue=mysql_query($sql); 
		}
		return $returnValue;
	}
	function change($productClass){
		$sql="update tbl_productClass set name='".$productClass->name."',sort=".$productClass->sort." where id=".$productClass->id;
		return mysql_query($sql);
	}
	function delete($id){
		$this->idStr=(string)$id;
		$this->listAll($id);
		$sql="delete from tbl_productClass where id in(".$this->idStr.")";
		return mysql_query($sql);
	}
	function listAll($upClassId){
		if($upClassId==0){
			$this->i=0;
			$sql="select * from tbl_productClass where upClassId=0 order by sort asc, id asc";
		}else{
			$sql="select * from tbl_productClass where upClassId=".$upClassId." order by sort asc, id asc";
		}
		$result=mysql_query($sql);
		while($a=mysql_fetch_array($result)){
			$this->idStr==""?$this->idStr=(string)$a["id"]:$this->idStr.=",".(string)$a["id"];
			$productClass=new ProductClass($a["name"],$a["upClassId"],$a["firstClassId"],$a["path"],$a["grade"],$a["sort"],$a["id"]);
			$this->arrAll[$this->i]=$productClass;
			$this->i+=1;
			$this->listAll($a["id"]);
		}
	}
	function getInfoById($id){
		$productClass;
		$sql="select * from tbl_productClass where id=".$id." limit 1";
		$result=mysql_query($sql);
		$arr[0];
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new ProductClass($a["name"],$a["upClassId"],$a["firstClassId"],$a["path"],$a["grade"],$a["sort"],$a["id"]);
			
		}else{
			$arr[0]=false;
			$arr[1]=new ProductClass();
		}
		return $arr;
	}
	function getTopOneInfo($upClassId){
		$newsClass;
		$sql="select * from tbl_productClass where upClassId=$upClassId order by sort asc,id asc limit 1";
		$result=mysql_query($sql);
		$arr[0];
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new NewsClass($a["name"],$a["upClassId"],$a["firstClassId"],$a["path"],$a["grade"],$a["sort"],$a["id"]);
	
		}else{
			$arr[0]=false;
			$arr[1]=new NewsClass();
		}
		return $arr;
	}
}
?>