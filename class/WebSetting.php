<?php
class WebSetting{
	var $id;
	var $webName;
	var $companyName;
	var $webAddress;
	var $webNumber;
	var $webCompanyAddress;
	var $webPhone;
	var $webFax;
	var $webEmail;
	var $webEmailPassword;
	var $webEmailSmtp;
	var $webQQ;
	var $webUpFileType;
	var $webUpFileSize;
	var $webKeyWords;
	var $webDescription;
	var $examOpen;
	var $majorType;
	var $examType;
	function __construct($webName="",$companyName="",$webAddress="",$webNumber="",$webCompanyAddress="",$webPhone="",$webFax="",$webEmail="",$webEmailPassword="",$webEmailSmtp="",$webQQ="",$webUpFileType="",$webUpFileSize=0,$webKeyWords="",$webDescription="",$examOpen=1,$majorType="",$examType="",$id=0){
		$this->webName=$webName;
		$this->companyName=$companyName;
		$this->webAddress=$webAddress;
		$this->webNumber=$webNumber;
		$this->webCompanyAddress=$webCompanyAddress;
		$this->webPhone=$webPhone;
		$this->webFax=$webFax;
		$this->webEmail=$webEmail;
		$this->webEmailPassword=$webEmailPassword;
		$this->webEmailSmtp=$webEmailSmtp;
		$this->webQQ=$webQQ;
		$this->webUpFileType=$webUpFileType;
		$this->webUpFileSize=$webUpFileSize;
		$this->webKeyWords=$webKeyWords;
		$this->webDescription=$webDescription;
		$this->examOpen=$examOpen;
		$this->majorType=$majorType;
		$this->examType=$examType;
		$this->id=$id;	
	}
}
?>