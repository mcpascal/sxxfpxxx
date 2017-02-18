<?php
class NewsClass{
	var $name;
	var $upClassId;
	var $firstClassId;
	var $path;
	var $grade;
	var $sort;
	var $id;
	function __construct($name="",$upClassId=0,$firstClassId=0,$path="",$grade=1,$sort=100,$id=0){
		$this->name=$name;
		$this->upClassId=$upClassId;
		$this->firstClassId=$firstClassId;
		$this->path=$path;
		$this->grade=$grade;
		$this->sort=$sort;
		$this->id=$id;
	}
}
?>