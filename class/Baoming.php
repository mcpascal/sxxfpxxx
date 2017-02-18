<?php
class Baoming{
	var $major;
	var $realname;
	var $sex;
	var $birthday;
	var $card;
	var $education;
	var $job;
	var $title;
	var $company;
	var $county;
	var $address;
	var $phone;
	var $address1;
	var $zipcode;
	var $email;
	var $addtime;
	var $id;
	function __construct($major="",$realname="",$sex="",$birthday="",$card="",$education="",$job="",$title="",$company="",$county="",$address="",$phone="",$address1="",$zipcode="",$email="",$addtime="",$id=0){
		$this->major=$major;
		$this->realname=$realname;
		$this->sex=$sex;
		$this->birthday=$birthday;
		$this->card=$card;
		$this->education=$education;
		$this->job=$job;
		$this->title=$title;
		$this->company=$company;
		$this->county=$county;
		$this->address=$address;
		$this->phone=$phone;
		$this->address1=$address1;
		$this->zipcode=$zipcode;
		$this->email=$email;
		$this->addtime=$addtime;
		$this->id=$id;
	}
}
?>