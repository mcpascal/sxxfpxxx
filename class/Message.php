<?php
class Message{
	var $personName;
	var $phone;
	var $email;
	var $title;
	var $content;
	var $addTime;
	var $id;
	function __construct($personName="",$phone="",$email="",$title="",$content="",$addTime="",$id=0){
		$this->personName=$personName;
		$this->phone=$phone;
		$this->email=$email;
		$this->title=$title;
		$this->content=$content;
		$this->addTime=$addTime;
		$this->id=$id;
	}
}
?>