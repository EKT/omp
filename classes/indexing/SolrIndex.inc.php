<?php
/**
 * Created by IntelliJ IDEA.
 * User: kstamatis
 * Date: 14/12/2017
 * Time: 10:54
 */


class SolrIndex
{
    public static function indexAbstract($monograph, $abstract, $nerd_response) {
        $temp = "";
        $options = array
        (
            'hostname' => 'localhost',
            'path' => 'solr/search',
            'port'     => 8983,
        );

        $client = new SolrClient($options);

        $doc = new SolrInputDocument();

        $doc->addField('id', $monograph->_data["id"]);

        for ($x = 0; $x <= count($nerd_response->entities); $x++) {
            $doc->addField('entity_value', $nerd_response->entities[$x]->raw_name);
        }
        $doc->addField('title', $monograph->getLocalizedFullTitle());
        $doc->addField('author', $monograph->getAuthorString());

        $updateResponse = $client->addDocument($doc);
        $client->commit();
    }

    public static function getFacets() {
        $options = array
        (
            'hostname' => 'localhost',
            'path' => 'solr/search',
            'port'     => 8983,
        );

        $client = new SolrClient($options);

        $query = new SolrQuery();

        $query->setStart(0);

        $query->setRows(50);
        $query->setFacet(true);
        $query->setQuery("*:*");
        $query->addFacetField("entity_value");

        $query_response = $client->query($query);

        $response = $query_response->getResponse();

        $facet_fields = $response['facet_counts']['facet_fields']['entity_value'];//->getPropertyNames();

        return $facet_fields;
    }
}