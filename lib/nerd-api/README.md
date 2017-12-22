PHP Client for NERD entity fishing API

This is a PHP library/wrapper of the <a target="_blank" href="http://nerd.readthedocs.io/">NERD API</a>.

<h2>Usage</h2>

Include: EKTWebServiceManager.php in your file

`require_once('EKTWebServiceManager.php');`

<b>Disambiguate Text</b>

`EKTWebServiceManager::disambiguateText(String searchText, String lang);`

Returns object of type: `EKTDisambiguateTextWebResponse`

<b>Disambiguate Short Text</b>

`EKTWebServiceManager::disambiguateShortText(String searchText, String lang);`

Returns object of type: `EKTDisambiguateShortTextWebResponse`

<b>Disambiguate Term Vector</b>

`EKTWebServiceManager::disambiguateTermVector(Array searchText, String lang);`

Returns object of type: `EKTDisambiguateTermWebResponse`

<b>Disambiguate PDF</b>

`EKTWebServiceManager::disambiguatePDF(String pdf_file_path, String lang);`

Returns object of type: `EKTDisambiguatePDFWebResponse`

<b>Concept</b>

`EKTWebServiceManager::concept(int concept_id, String lang);`

Returns object of type: `EKTConceptWebResponse`

<b>Term</b>

`EKTWebServiceManager::term(int term_id, String lang);`

Returns object of type: `EKTTermWebResponse`

<b>Language</b>

`EKTWebServiceManager::language(String text);`

Returns object of type: `EKTLanguageWebResponse`

<b>Segmentation</b>

`EKTWebServiceManager::segmentation(String text);`

Returns object of type: `EKTSegmentationWebResponse`

<h3>Responses</h3>

All response objects have the following three public variables:

`public $has_error;`
 
`public $status_code;`
  
`public $error_msg;`

Use the variables to check for API request errors before proceeding to the actual response data.
  
