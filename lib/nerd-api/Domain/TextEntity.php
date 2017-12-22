<?php

require_once('Position.php');

class TextEntity
{
    public $raw_name; //string
	public $type; //string
	public $offset_start; //int
	public $offset_end; //int
	public $nerd_score; //double
	public $nerd_selection_score; //double
	public $wikipedia_ext_ref; //int (?)
	public $wikidata_id; //string
	public $domains = array(); //array of strings
	public $pos = array(); // array of Position

    public $concept_response; //EKTConceptWebResponse

	//Constructor
	function __construct($data) {
		$this->raw_name = $data['rawName'];
		$this->type = array_key_exists('type', $data) ? $data['type'] : NULL;
		$this->offset_start = array_key_exists('offsetStart', $data) ? $data['offsetStart'] : NULL;
		$this->offset_end = array_key_exists('offsetEnd', $data) ? $data['offsetEnd'] : NULL;
		$this->nerd_score = $data['nerd_score'];
		$this->nerd_selection_score = $data['nerd_selection_score'];
		$this->wikipedia_ext_ref = array_key_exists('wikipediaExternalRef', $data) ? $data['wikipediaExternalRef'] : NULL;
		$this->wikidata_id = array_key_exists('wikidataId', $data) ? $data['wikidataId'] : NULL;
		$this->domains = array_key_exists('domains', $data) ? $data['domains'] : array();
		
		$positions = array_key_exists('pos', $data) ? $data["pos"] : NULL;
		if ($positions){
			foreach ($positions as $position) {
				array_push($this->pos, new Position($position));
			}
		}

		//Try to get the term
        if (!is_null($this->wikidata_id)) {
            $ekt_response = EKTWebServiceManager::concept($this->wikidata_id, 'en');
            if (!$ekt_response->has_error){
                $this->concept_response = $ekt_response;
            }
        }
	}

	function getDomainsText($separator){
	    $result = NULL;
        for( $j = 0; $j<count($this->domains); $j++ ) {
            if (!is_null($result)){
                $result = $result.$separator;
            }
            else {
                $result = "";
            }
            $result = $result . $this->domains[$j];
        }

        return $result;
    }

    function getDefinition(){
	    if (!is_null($this->concept_response)){
            return $this->concept_response->definitions[0]->definition;
        }
        return "";
    }
}