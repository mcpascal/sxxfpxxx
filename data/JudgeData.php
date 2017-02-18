<?php
class JudgeData{
	public $table = "tbl_judge";
	function add($judgeArr){
		$sql = "";
		for($i = 0; $i <count($judgeArr); $i ++){
			$sql .= ",('".$judgeArr[$i]->classname."','".$judgeArr[$i]->title."',".$judgeArr[$i]->answer.")";
		}
		$sql = substr($sql, 1);
		$sql = "insert into {$this->table}(classname, title, answer) values" . $sql;
		return mysql_query($sql);
	}
	function change($judge){
		$sql="update {$this->table} set classname='".$judge->classname."', title='".$judge->title."', answer=".$judge->answer." where id=".$judge->id;
		//echo $sql;
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
		$arrJudge;
		$sql.=" limit ".$page->pageListNumber*($page->currentPage-1).",".$page->pageListNumber;
		$result=mysql_query($sql);
		$i=0;
		while($a=mysql_fetch_array($result)){
			$judge=new Judge($a["classname"], $a["title"], $a["answer"], $a["id"]);
			$arrJudge[$i]=$judge;
			$i+=1;
		}
		$arr[0]=$page;
		$arr[1]=$arrJudge;
		return $arr;
	}
	function getInfoById($id){
		$sql="select * from {$this->table} where id=".$id;
		$result=mysql_query($sql);
		$arr[0]=false;
		if(mysql_num_rows($result)>0){
			$arr[0]=true;
			$a=mysql_fetch_array($result);
			$arr[1]=new Judge($a["title"], $a["answer"], $a["id"]);
		}
		return $arr;
	}
	
	function listRandom($num,$classname){
		//$sql = "SELECT * FROM {$this->table} AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM {$this->table})-(SELECT MIN(id) FROM {$this->table}))+(SELECT MIN(id) FROM {$this->table})) AS id) AS t2  WHERE t1.id >= t2.id ORDER BY t1.id LIMIT {$num}";
		$sql = "select *, rand() as random from {$this->table} where classname='{$classname}' order by random limit {$num}";
		$result = mysql_query($sql);
		$arrJudge;
		$i = 0;
		while($a = mysql_fetch_array($result)){
			$judge=new Judge($a["classname"], $a["title"], $a["answer"], $a["id"]);
			$arrJudge[$i] = $judge;
			$i += 1;
		}
		return $arrJudge;
	}
	function checkAnswer($id, $answer){
		if($answer == ""){
			return false;
		}else{
			$sql="select * from {$this->table} where id=".$id . " and answer=" . $answer;
			$result=mysql_query($sql);
			return (mysql_num_rows($result)>0 ? true : false);
		}
	}
}
?>