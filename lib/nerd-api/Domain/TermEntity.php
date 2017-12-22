<?php

require_once('TermEntityDefinition.php');
require_once('NerdCategory.php');

class TermEntity
{

	public $raw_name; //string
	public $preferred_term; //string
	public $nerd_score; //double
	public $nerd_selection_score; //double
	public $wikipedia_ext_ref; //int (?)
	public $wikidata_id; //string
	public $definitions = array(); //array of TermEntityDefinition 
	public $categories = array(); //array of Category
	
	//Constructor
	function __construct($data) {
		$this->raw_name = $data['rawName'];
		$this->preferred_term = $data['preferredTerm'];
		$this->nerd_score = $data['nerd_score'];
		$this->nerd_selection_score = $data['nerd_selection_score'];
		$this->wikipedia_ext_ref = $data['wikipediaExternalRef'];
		$this->wikidata_id = $data['wikidataId'];
		
		$definitions = $data["definitions"];
		if ($definitions){
			foreach ($definitions as $definition) {
				array_push($this->definitions, new TermEntityDefinition($definition));
			}
		}
		
		$categories = $data["categories"];
		if ($categories){
			foreach ($categories as $category) {
				array_push($this->categories, new Category($category));
			}
		}
	}
}