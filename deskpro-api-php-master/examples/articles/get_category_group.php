<?php

/*
 * This example demonstrates how to determine 
 * if a particular group ID exists for an article category.
 */

 //-----------------------------------------------------
// DESKPRO API SETTINGS
//-----------------------------------------------------

require __DIR__.'/../../deskpro-api.php';

$deskpro_url   = 'http://example.com/deskpro';   // The URL to your helpdesk
$api_key       = '123:XYZ';                      // Your API key (Admin > Apps > API Keys)

// First, create the API object
$api = new \DeskPRO\Api($deskpro_url, $api_key);

//-----------------------------------------------------
// EXAMPLE VARIABLES
//-----------------------------------------------------

// The category ID to search for
$category_id 	= 5;

// The group ID to searh for
$group_id	= 9;

//-----------------------------------------------------
// EXAMPLE CODE
//-----------------------------------------------------

// Then we can get our results
$result = $api->articles->getCategoryGroup($category_id, $group_id);

if (!$result->isError()) {
	// Request completed successfully
	$data = $result->getData();
	print_r($data);
} else {
	// Something is wrong . . .  Put on your DEBUG shoes
	echo $result->getErrorMessage();
}