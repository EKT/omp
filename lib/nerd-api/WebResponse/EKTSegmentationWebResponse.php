<?php

require_once('EKTGenericWebResponse.php');
require_once(__DIR__.'/../Domain/Sentence.php');

class EKTSegmentationWebResponse extends EKTGenericWebResponse
{
	public $sentences = array(); //array of Sentence
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request, $response);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
			$sentences = $json["sentences"];
			if ($sentences){
				foreach ($sentences as $sentence) {
					array_push($this->sentences, new Sentence($sentence));
				}
			}
		}
   	}
}