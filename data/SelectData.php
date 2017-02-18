<?php
class SelectData{
	public $table = "tbl_select";
	
	function add($select){
		$s = $select;
		$sql = "insert into {$this -> table} (classname, type, title, a, b, c, d, answer) values ('{$s -> classname}', {$s -> type}, '{$s -> title}', '{$s -> a}', '{$s -> b}', '{$s -> c}', '{$s -> d}', '{$s -> answer}')";
		return mysql_query($sql);
	}
	
	function change($select){
		$s = $select;
		$sql = "update {$this -> table} set classname='{$s -> classname}', type={$s -> type}, title='{$s -> title}', a='{$s -> a}', b='{$s -> b}', c='{$s -> c}', d='{$s -> d}', answer='{$s -> answer}' where id = {$s -> id}";
		return mysql_query($sql);
	}
	
	function listBySql($sql, $page){
		$sql = str_replace("[/table/]", $this->table, $sql);
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		$pageNumber = (int)($num / $page -> pageListNumber);
		if($num % $page -> pageListNumber > 0){
			$pageNumber += 1;
		}
		$page -> pageNumber = $pageNumber;
		$page -> allNumber = $num;
		is_numeric($page -> currentPage) ? $page -> currentPage = (int)$page -> currentPage : $page -> currentPage = 1;
		if($page -> currentPage < 1 || $page -> currentPage > $pageNumber){
			$page -> currentPage = 1;
		}
		$arrSelect;
		$sql .= " limit " . $page->pageListNumber*($page->currentPage-1) . "," . $page->pageListNumber;
		$result = mysql_query($sql);
		$i = 0;
		while($a = mysql_fetch_array($result)){
			$select = new Select($a["classname"], $a["type"], $a["title"], $a["a"], $a["b"], $a["c"], $a["d"], $a["answer"], $a["id"]);
			$arrSelect[$i] = $select;
			$i += 1;
		}
		$arr[0] = $page;
		$arr[1] = $arrSelect;
		return $arr;
	}
	
	function delete($id){
		$sql="delete from {$this->table} where id in(" . $id . ")";
		return mysql_query($sql);
	}
	
	function getInfoById($id){
		$sql = "select * from {$this->table} where id=" . $id;
		$result = mysql_query($sql);
		$arr[0] = false;
		if(mysql_num_rows($result) > 0){
			$arr[0] = true;
			$a = mysql_fetch_array($result);
			$arr[1] = new Select($a["classname"], $a["type"], $a["title"], $a["a"], $a["b"], $a["c"], $a["d"], $a["answer"], $a["id"]);
		}
		return $arr;
	}
	
	
	
	function listRandom($type, $num, $classname){
		//$sql = "SELECT * FROM {$this->table} AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM {$this->table})-(SELECT MIN(id) FROM {$this->table}))+(SELECT MIN(id) FROM {$this->table})) AS id) AS t2  WHERE t1.id >= t2.id AND t1.type={$type} ORDER BY t1.id LIMIT {$num}";
		$sql = "select *, rand() as random from {$this->table} where type={$type} and classname='{$classname}' order by random limit {$num}";
		$result = mysql_query($sql);
		$arrSelect;
		$i = 0;
		while($a = mysql_fetch_array($result)){
			$select = new Select($a["classname"], $a["type"], $a["title"], $a["a"], $a["b"], $a["c"], $a["d"], $a["answer"], $a["id"]);
			$arrSelect[$i] = $select;
			$i += 1;
		}
		return $arrSelect;
	}
	
	function checkAnswer($id, $answer){
		if($answer == ""){
			return false;
		}else{
			$sql="select * from {$this->table} where id=".$id . " and answer='{$answer}'";
			$result=mysql_query($sql);
			return (mysql_num_rows($result)>0 ? true : false);
		}
	}
	
}
?>