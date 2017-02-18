<?php
class SinglePage{
	var $singlePageClassId;
	var $title;
	var $content;
	var $sort;
	var $id;
	function __construct($singlePageClassId=0,$title="",$content="",$sort=50,$id=0){
		$this->singlePageClassId=$singlePageClassId;
		$this->title=$title;
		$this->content=$content;
		$this->sort=$sort;
		$this->id=$id;
	}
}
?>