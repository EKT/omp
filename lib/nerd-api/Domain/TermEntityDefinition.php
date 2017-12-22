<?php
class TermEntityDefinition
{

	public $definition; //string
	public $source; //string
	public $lang; //string
	
	//Constructor
	function __construct($data) {
		$this->lang = $data['lang'];
		$this->source = $data['source'];
		$this->definition = $data['definition'];
	}
}