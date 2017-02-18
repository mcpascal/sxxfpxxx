<?php
class News{
	var $newsClassId;
	var $title;
	var $image;
	var $content;
	var $indexSort;
	var $classSort;
	var $addTime;
	var $id;
	function __construct($newsClassId=0,$title="",$image="",$content="",$indexSort=100,$classSort=100,$addTime,$id=0){
		$this->newsClassId=$newsClassId;
		$this->title=$title;
		$this->image=$image;
		$this->content=$content;
		$this->indexSort=$indexSort;
		$this->classSort=$classSort;
		$this->addTime=$addTime;
		$this->id=$id;
	}
}
?>