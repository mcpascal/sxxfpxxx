<?php
class SinglePageClassData{
	var $arrAll;
	var $i=0;
	var $idStr="";
	function add($singlePageClass){
		$sql="insert into tbl_singlePageClass(name,upClassId,firstClassId,path,grade,sort) values('".$singlePageClass->name."',".$singlePageClass->upClassId.",".$singlePageClass->firstClassId.",'".$singlePageClass->path."',".$singlePageClass->grade.",".$singlePageClass->sort.")";
		return mysql_query($sql);
	}
	function addByUpClassId($upClassId,$singlePageClass){
		$returnValue=false;
		$sql="select * from tbl_singlePageClass where id=".$upClassId;
		$result=mysql_query($sql);
		if(mysql_num_rows($result)==0){
			$returnValue=false;
		}else{
			$a=mysql_fetch_array($result);
			$upSinglePageClass=new SinglePageClass($a["name"],$a["upClassId"],$a["firstClassId"],$a["path"],$a["grade"],$a["sort"],$a["id"]);
			$sql="insert into tbl_singlePageClass(name,upClassId,firstClassId,path,grade,sort) values('".$singlePageClass->name."',".$upSinglePageClass->id.",".$upSinglePageClass->firstClassId.",'".$upSinglePageClass->path.",".(string)$upSinglePageClass->id."',".($upSinglePageClass->grade+1).",".$singlePageClass->sort.")";
			$returnValue=mysql_query($sql); 
		}
		return $returnValue;
	}
	function change($singlePageClass){
		$sql="update tbl_singlePageClass set name='".$singlePageClass->name."',sort=".$singlePageClass->sort." where id=".$singlePageClass->id;
		return mysql_query($sql);
	}
	function delete($id){
		$this->idStr=(string)$id;
		$this->listAll($id);
		$sql="delete from tbl_singlePageClass where id in(".$this->idStr.")";
		return mysql_query($sql);
	}
	function listAll($upClassId){
		if($upClassId==0){
			$this->i=0;
			$sql="select * from tbl_singlePageClass where upClassId=0 order by sort asc, id asc";
		}else{
			$sql="select * from tbl_singlePageClass where upClassId=".$upClassId." order by sort asc, id asc";
		}
		$result=mysql_query($sql);
		while($a=mysql_fetch_array($result)){
			$this->idStr==""?$this->idStr=(string)$a["id"]:$this->idStr.=",".(string)$a["id"];
			$singlePageClass=new SinglePageClass($a["name"],$a["upClassId"],$a["firstClassId"],$a["path"],$a["grade"],$a["sort"],$a["id"]);
			$this->arrAll[$this->i]=$singlePageClass;
			$this->i+=1;
			$this->listAll($a["id"]);
		}
	}
	function getInfoById($id){
		$singlePageClass;
		$sql="select * from tbl_singlePageClass where id=".$id." limit 1";
		$result=mysql_query($sql);
		$arr=array();
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new SinglePageClass($a["name"],$a["upClassId"],$a["firstClassId"],$a["path"],$a["grade"],$a["sort"],$a["id"]);
			
		}else{
			$arr[0]=false;
			$arr[1]=new SinglePageClass();
		}
		return $arr;
	}
}
?>