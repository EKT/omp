{**
 * templates/frontend/pages/catalog.tpl
 *
 * Copyright (c) 2014-2017 Simon Fraser University Library
 * Copyright (c) 2003-2017 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @brief Display the page to view the catalog.
 *
 * @uses $publishedMonographs array List of published monographs
 *}
{include file="frontend/components/header.tpl" pageTitle="navigation.catalog"}

<div class="nerd-tag-cloud">
    {$tagcloud_html}
</div>

{include file="frontend/components/footer.tpl"}
