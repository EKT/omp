<?php
class Nerdcategory
{

	public $weight; //double
	public $source; //string
	public $category; //string
	public $page_id; //int (?)
	
	//Constructor
	function __construct($data) {
		$this->weight = array_key_exists('weight', $data) ? $data['weight'] : NULL;
		$this->source = $data['source'];
		$this->category = $data['category'];
		$this->page_id = $data['page_id'];
	}
}