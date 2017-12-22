<?php

/**
 * @file pages/catalog/CatalogHandler.inc.php
 *
 * Copyright (c) 2014-2017 Simon Fraser University Library
 * Copyright (c) 2003-2017 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CatalogHandler
 * @ingroup pages_catalog
 *
 * @brief Handle requests for the press-specific part of the public-facing
 *   catalog.
 */

import('classes.handler.Handler');

// import UI base classes
import('lib.pkp.classes.linkAction.LinkAction');
import('lib.pkp.classes.core.JSONMessage');
require_once('./classes/indexing/SolrIndex.inc.php');
require_once('./lib/tagcloud/TagCloud.php');

class TagCloudHandler extends Handler {
	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
	}


	//
	// Overridden methods from Handler
	//
	/**
	 * @see PKPHandler::authorize()
	 */
	function authorize($request, &$args, $roleAssignments) {
		import('lib.pkp.classes.security.authorization.ContextRequiredPolicy');
		$this->addPolicy(new ContextRequiredPolicy($request));
		return parent::authorize($request, $args, $roleAssignments);
	}


	//
	// Public handler methods
	//
	/**
	 * Show the catalog home.
	 * @param $args array
	 * @param $request PKPRequest
	 */
	function index($args, $request) {
		$templateMgr = TemplateManager::getManager($request);
		$this->setupTemplate($request);

        $facet_fields = SolrIndex::getFacets();
        $facet_names = $facet_fields->getPropertyNames();

        $cloud = new TagCloud();
        $cloud->setOption("transformation", null);
        $cloud->setOption("transliterate", false);
        for ($x = 0; $x < count($facet_names); $x++) {
        	$facet_name = $facet_names[$x];
        	$times = $facet_fields->offsetGet($facet_name);

        	$cloud->addTag(array('tag' => $facet_name, 'size' => $times));
        }

		$html = $cloud->render();

        $templateMgr->assign('facet_fields', $facet_fields);
        $templateMgr->assign('tagcloud_html', $html);

		// Display
		$templateMgr->display('frontend/pages/tagcloud.tpl');
	}

	/**
	 * Set up the basic template.
	 */
	function setupTemplate($request) {
		$templateMgr = TemplateManager::getManager($request);
		$press = $request->getPress();
		if ($press) {
			$templateMgr->assign('currency', $press->getSetting('currency'));
		}
		parent::setupTemplate($request);
	}
}

?>
