<?php
class Select{
	public $id;
	public $classname;
	public $type;
	public $title;
	public $a;
	public $b;
	public $c;
	public $d;
	public $answer;
	
	function __construct($classname = "", $type = 1, $title = "", $a = "", $b = "", $c = "", $d = "", $answer = "", $id = 0){
		$this -> classname = $classname;
		$this -> type = $type;
		$this -> title = $title;
		$this -> a = $a;
		$this -> b = $b;
		$this -> c = $c;
		$this -> d = $d;
		$this -> answer = $answer;
		$this->id = $id;
	}
}
?>