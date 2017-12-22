<?php

require_once('EKTGenericWebResponse.php');

class EKTDisambiguateWebResponse extends EKTGenericWebResponse
{
	// property declaration
	public $runtime;
	public $onlyNER;
	public $nbest;
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
			$this->runtime = $json["runtime"];
			$this->onlyNER = $json["onlyNER"];
			$this->nbest = $json["nbest"];
		}
   }
}