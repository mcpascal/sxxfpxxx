<?php
class Product{
	var $productClassId;
	var $title;
	var $image;
	var $content;
	var $indexSort;
	var $classSort;
	var $addTime;
	var $id;
	function __construct($productClassId=0,$title="",$image="",$content="",$indexSort=100,$classSort=100,$addTime,$id=0){
		$this->productClassId=$productClassId;
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