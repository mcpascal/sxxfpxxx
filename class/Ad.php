<?php
class Ad{
	var $link;
	var $image;
	var $sort;
	var $id;
	function __construct($link,$image="",$sort=100,$id=0){
		$this->link=$link;
		$this->image=$image;
		$this->sort=$sort;
		$this->id=$id;
	}
}
?>