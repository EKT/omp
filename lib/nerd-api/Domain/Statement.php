<?php
class Statement
{

	public $concept_id; //string
	public $property_id; //string
	public $property_name; //string
	public $value_type; //string
	public $value; //string or array (depending on $value_type
	public $value_name; //string
	
	//Constructor
	function __construct($data) {
		$this->concept_id = $data['conceptId'];
		$this->property_id = $data['propertyId'];
		$this->property_name = $data['propertyName'];
		$this->value_type = $data['valueType'];
		$this->value = $data['value'];
		$this->value_name = array_key_exists('valueName', $data) ? $data['valueName'] : NULL;
	}
}