<?php
class Judge{
	var $classname;
	var $title;
	var $answer;
	var $id;
	
	function __construct($classname = "", $title = "", $answer = 0 ,$id = 0){
		$this->classname = $classname;
		$this->title = $title;
		$this->answer = $answer;
		$this->id = $id;
	}
}
?>