<?php
class Recruitment {
	public $title;
	public $money;
	public $num;
	public $education;
	public $nature;
	public $description;
	public $sort;
	public $id;
	
	function __construct($title="",$money="",$num="",$education="",$nature="",$description,$sort=50,$id=0){
		$this->title=$title;
		$this->money=$money;
		$this->num=$num;
		$this->education=$education;
		$this->nature=$nature;
		$this->description=$description;
		$this->sort=$sort;
		$this->id=$id;
	}
}

?>