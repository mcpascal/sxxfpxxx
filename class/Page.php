<?php
class Page{
	var $allNumber;//记录总数
	var $pageNumber;//总页数
	var $pageListNumber;//每页显示条数
	var $currentPage;//当前页数
	function __construct($allNumber=0,$pageNumber=0,$pageListNumber=0,$currentPage=1){
		$this->allNumber=$allNumber;
		$this->pageNumber=$pageNumber;
		$this->pageListNumber=$pageListNumber;
		$this->currentPage=$currentPage;
	}
}
?>