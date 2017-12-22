<?php

require_once('TermEntity.php');
require_once('Multilingual.php');

class Term
{

	public $term; //string
	public $score; //double
	public $entities = array(); //array of TermEntity
	public $multilingual = array(); //array of Multilingual
	
	//Constructor
	function __construct($data) {
		$this->term = $data['term'];
		$this->score = $data['score'];
		
		$entities = $data["entities"];
		if ($entities){
			foreach ($entities as $entity) {
				array_push($this->entities, new TermEntity($entity));
			}
		}
		
		$multilinguals = array_key_exists('multilingual', $data) ? $data["multilingual"] : NULL;
		if ($multilinguals){
			foreach ($multilinguals as $multilingual) {
				array_push($this->multilingual, new Multilingual($multilingual));
			}
		}
	}
}