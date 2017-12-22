<?php
class Page
{

	public $page_height; //double
	public $page_width; //double
	
	//Constructor
	function __construct($data) {
		$this->page_height = $data['page_height'];
		$this->page_width = $data['page_width'];
	}
}