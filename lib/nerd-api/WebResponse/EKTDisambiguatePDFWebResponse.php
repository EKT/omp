<?php

require_once('EKTDisambiguateWebResponse.php');
require_once(__DIR__.'/../Domain/Language.php');
require_once(__DIR__.'/../Domain/TextEntity.php');
require_once(__DIR__.'/../Domain/Page.php');

class EKTDisambiguatePDFWebResponse extends EKTDisambiguateWebResponse
{
	public $language; //Language
	public $entities = array(); //array of TextEntity
	public $pages = array(); //array of Page
	
	//Constructor
	function __construct($request, $response) {
		parent::__construct($request, $response);
	
		if (!$this->has_error){
			$json = json_decode($response, true);
			
      		$lang_data = $json["language"];
      		if ($lang_data){
      			$this->language = new Language($lang_data);
      		}
      		
      		$entities = $json["entities"];
      		if ($entities){
      			foreach ($entities as $entity) {
      				array_push($this->entities, new TextEntity($entity));
      			}
      		}
      		
      		$pages = $json["pages"];
      		if ($pages){
      			foreach ($pages as $page) {
      				array_push($this->pages, new Page($page));
      			}
      		}
		}
   	}
}