<?php
class Multilingual
{

	public $lang; //string
	public $term; //double
	public $page_id; //int (?)
	
	//Constructor
	function __construct($data) {
		$this->lang = $data['lang'];
		$this->term = $data['term'];
		$this->page_id = $data['page_id'];
	}
}