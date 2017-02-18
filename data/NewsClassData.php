<?php
class NewsClassData{
	var $arrAll;
	var $i=0;
	var $idStr="";
	function add($newsClass){
		$sql="insert into tbl_newsClass(name,upClassId,firstClassId,path,grade,sort) values('".$newsClass->name."',".$newsClass->upClassId.",".$newsClass->firstClassId.",'".$newsClass->path."',".$newsClass->grade.",".$newsClass->sort.")";
		return mysql_query($sql);
	}
	function addByUpClassId($upClassId,$newsClass){
		$returnValue=false;
		$sql="select * from tbl_newsClass where id=".$upClassId;
		$result=mysql_query($sql);
		if(mysql_num_rows($result)==0){
			$returnValue=false;
		}else{
			$a=mysql_fetch_array($result);
			$upNewsClass=new NewsClass($a["name"],$a["upClassId"],$a["firstClassId"],$a["path"],$a["grade"],$a["sort"],$a["id"]);
			
			$sql="insert into tbl_newsClass(name,upClassId,firstClassId,path,grade,sort) values('".$newsClass->name."',".$upNewsClass->id.",".$upNewsClass->firstClassId.",'".$upNewsClass->path.",".(string)$upNewsClass->id."',".($upNewsClass->grade+1).",".$newsClass->sort.")";
			$returnValue=mysql_query($sql); 
		}
		return $returnValue;
	}
	function change($newsClass){
		$sql="update tbl_newsClass set name='".$newsClass->name."',sort=".$newsClass->sort." where id=".$newsClass->id;
		return mysql_query($sql);
	}
	function delete($id){
		$this->idStr=(string)$id;
		$this->listAll($id);
		$sql="delete from tbl_newsClass where id in(".$this->idStr.")";
		return mysql_query($sql);
	}
	function listAll($upClassId){
		if($upClassId==0){
			$this->i=0;
			$sql="select * from tbl_newsClass where upClassId=0 order by sort asc, id asc";
		}else{
			$sql="select * from tbl_newsClass where upClassId=".$upClassId." order by sort asc, id asc";
		}
		$result=mysql_query($sql);
		while($a=mysql_fetch_array($result)){
			$this->idStr==""?$this->idStr=(string)$a["id"]:$this->idStr.=",".(string)$a["id"];
			$newsClass=new NewsClass($a["name"],$a["upClassId"],$a["firstClassId"],$a["path"],$a["grade"],$a["sort"],$a["id"]);
			$this->arrAll[$this->i]=$newsClass;
			$this->i+=1;
			$this->listAll($a["id"]);
		}
	}
	function getInfoById($id){
		$newsClass;
		$sql="select * from tbl_newsClass where id=".$id." limit 1";
		$result=mysql_query($sql);
		$arr=array();
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
	function getTopOneInfo($upClassId){
		$newsClass;
		$sql="select * from tbl_newsClass where upClassId=$upClassId order by sort asc,id asc limit 1";
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