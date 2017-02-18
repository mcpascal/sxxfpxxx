<?php
class ScoreData{
	public $table = "tbl_score";
	function add($score){
		$sql = "insert into {$this->table}(classname,username, score, addtime) values('{$score->classname}','{$score->username}',{$score->score}, '{$score->addtime}')" ;
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
		$arrScore;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$score=new Score($a["classname"], $a["username"], $a["score"], $a["addtime"], $a["id"]);
			$arrScore[$i]=$score;
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrScore;
		return $arr;
	}
	function fetchAllScore($sql){
		$sql = str_replace("[/table/]", $this->table, $sql);
		
		$result=mysql_query($sql);
		$num=mysql_num_rows($result);
		//$pageNumber=(int)($num/$page->pageListNumber);
		
		$i=0;
		while($a=mysql_fetch_array($result)){
			$score=new Score($a["classname"], $a["username"], $a["score"], $a["addtime"], $a["id"]);
			$arrScore[$i]=$score;
			$i+=1;
		}
		//$arr[0]=$page;
		//$arr[1]=$arrScore;
		return $arrScore;
	}
	function listAllByUserName($userName){
		$sql="select * from {$this->table} where username='{$userName}' order by score desc, id desc";
		$result=mysql_query($sql);
		$arr = array();
		while($a = mysql_fetch_array($result)){
			$arr[] = new Score($a["classname"], $a["username"], $a["score"], $a["addtime"], $a["id"]);
		}
		return $arr;
	}
	function getInfoById($id){
		$sql="select * from {$this->table} where id=".$id;
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=$score=new Score($a["classname"], $a["username"], $a["score"], $a["addtime"], $a["id"]);
		}
		return $arr;
	}
	function getMaxScore($username){
		$sql = "select max(score) as maxscore from {$this->table} where username='{$username}'";
		$result=mysql_query($sql);
		$a=mysql_fetch_array($result);
		return ($a["maxscore"] == "" ? 0 : $a["maxscore"]);
	}
}
?>