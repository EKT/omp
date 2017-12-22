<?php
class EKTGenericWebResponse
{
	// property declaration
	public $has_error;
	public $status_code;
	public $error_msg;

	//Constructor
	function __construct($request) {
		$this->status_code = curl_getinfo($request, CURLINFO_HTTP_CODE);
		if ($this->status_code == 200){
			$this->has_error = FALSE;
		}
		else {
			$this->has_error = TRUE;
			switch ($this->status_code) {
				case 400:  
					$this->error_msg = "Wrong request, missing parameters, missing header";
					break;
				case 404:
					$this->error_msg = "Property was not found";
					break;
				case 405:
					$this->error_msg = "Method not allowed";
					break;
				case 406:
					$this->error_msg = "The language is not supported";
					break;
				case 500:
					$this->error_msg = "Internal service error";
					break;
				default:
					$this->error_msg = "Generic error";
			}
		}
	}
}