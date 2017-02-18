<?php
class Score{
	var $classname;
	var $username;
	var $score;
	var $addtime;
	var $id;
	
	function __construct($classname = "", $username = "", $score = 0, $addtime='', $id = 0){
		$this->classname = $classname;
		$this->username = $username;
		$this->score = $score;
		$this->addtime = $addtime;
		$this->id = $id;
	}
}
?>