<?php
class Sense
{

	public $page_id; //int
	public $preferred; //string
	public $prob_c; //double
	
	//Constructor
	function __construct($data) {
		$this->page_id = $data['pageid'];
		$this->preferred = $data['preferred'];
		$this->prob_c = $data['prob_c'];
	}
}