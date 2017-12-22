<?php
require_once('WebResponse/EKTDisambiguateTextWebResponse.php');
require_once('WebResponse/EKTDisambiguateShortTextWebResponse.php');
require_once('WebResponse/EKTDisambiguateTermWebResponse.php');
require_once('WebResponse/EKTDisambiguatePDFWebResponse.php');
require_once('WebResponse/EKTConceptWebResponse.php');
require_once('WebResponse/EKTTermWebResponse.php');
require_once('WebResponse/EKTLanguageWebResponse.php');
require_once('WebResponse/EKTSegmentationWebResponse.php');

class EKTWebServiceManager
{
    public static $nerd_service_base_url;

	public static function disambiguateText($search_text, $lang) {
		return EKTWebServiceManager::disambiguate($search_text, NULL, NULL, NULL, $lang);
	}
	
	public static function disambiguateShortText($short_text, $lang) {
		
		return EKTWebServiceManager::disambiguate(NULL, $short_text, NULL, NULL, $lang);
	}
	
	public static function disambiguateTermVector($term_vector, $lang) {
		return EKTWebServiceManager::disambiguate(NULL, NULL, $term_vector, NULL, $lang);
	}
	
	public static function disambiguatePDF($file_path, $lang) {
		return EKTWebServiceManager::disambiguate(NULL, NULL, NULL, $file_path, $lang);
	}
	
	private static function disambiguate($search_text, $short_text, $term_vector, $file_path, $lang) {
        $nerd_service_base_url = Config::getVar('nerd', 'nerd_service_base_url');

		$query = array(
				'entities' => [],
				'onlyNER' => FALSE,
				'resultLanguages' => array('de', 'fr'),
				'nbest' => FALSE,
				'sentence' => FALSE,
				'customisation' => 'generic'
		);
		if (!$file_path){
			$query['text'] = $search_text?$search_text:'';
			$query['shortText'] = $short_text?$short_text:'';
			$query['termVector'] = $term_vector?$term_vector:[];
		}
		
		if ($lang){
			$query['language'] = array('lang' => $lang);
		}
		
		$data = array('query' => json_encode($query));
		if ($file_path){
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$finfo = finfo_file($finfo, $file_path);
			$data['file'] = new CurlFile($file_path, $finfo, basename($file_path));
		}
		
		$url = $nerd_service_base_url."/disambiguate";
		$request = curl_init($url);
		curl_setopt ($request, CURLOPT_POST, 1);
		curl_setopt($request, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
		curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
		
		curl_setopt($request, CURLOPT_POSTFIELDS, $data);
		
		$response = curl_exec($request);

		if ($search_text){
			$ekt_response = new EKTDisambiguateTextWebResponse($request, $response);
			return $ekt_response;
		}
		else if ($short_text){
			$ekt_response = new EKTDisambiguateShortTextWebResponse($request, $response);
			return $ekt_response;
		}
		else if ($term_vector){
			$ekt_response = new EKTDisambiguateTermWebResponse($request, $response);
			return $ekt_response;
		}
		else if ($file_path){
			$ekt_response = new EKTDisambiguatePDFWebResponse($request, $response);
			return $ekt_response;
		}
		
		return NULL;
	}
	
	public static function concept($concept_id, $lang) {
        $nerd_service_base_url = Config::getVar('nerd', 'nerd_service_base_url');

		$url = $nerd_service_base_url."/kb/concept/".$concept_id;
		if ($lang){
			$url .= "?lang=".$lang;
		}
		
		$request = curl_init($url);
		curl_setopt($request, CURLOPT_POST, 0);
		curl_setopt($request, CURLOPT_HTTPGET, 1);
		curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
	
		$response = curl_exec($request);
		
		$ekt_response = new EKTConceptWebResponse($request, $response);
		return $ekt_response;
	}
	
	public static function term($concept_id, $lang) {
        $nerd_service_base_url = Config::getVar('nerd', 'nerd_service_base_url');

		$url = $nerd_service_base_url."/kb/term/".$concept_id;
		if ($lang){
			$url .= "?lang=".$lang;
		}
	
		$request = curl_init($url);
		curl_setopt($request, CURLOPT_POST, 0);
		curl_setopt($request, CURLOPT_HTTPGET, 1);
		curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
	
		$response = curl_exec($request);
	
		$ekt_response = new EKTTermWebResponse($request, $response);
		return $ekt_response;
	}
	
	public static function language($text) {
        $nerd_service_base_url = Config::getVar('nerd', 'nerd_service_base_url');

		$data = array('text' => $text);
	
		$url = $nerd_service_base_url."/language";
		$request = curl_init($url);
		curl_setopt ($request, CURLOPT_POST, 1);
		curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
	
		curl_setopt($request, CURLOPT_POSTFIELDS, $data);
	
		$response = curl_exec($request);
	
		$ekt_response = new EKTLanguageWebResponse($request, $response);
		return $ekt_response;
	}
	
	public static function segmentation($text) {
        $nerd_service_base_url = Config::getVar('nerd', 'nerd_service_base_url');

		$data = array('text' => $text);
	
		$url = $nerd_service_base_url."/segmentation";
		$request = curl_init($url);
		curl_setopt ($request, CURLOPT_POST, 1);
		curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
	
		curl_setopt($request, CURLOPT_POSTFIELDS, $data);
	
		$response = curl_exec($request);
	
		$ekt_response = new EKTSegmentationWebResponse($request, $response);
		return $ekt_response;
	}
}