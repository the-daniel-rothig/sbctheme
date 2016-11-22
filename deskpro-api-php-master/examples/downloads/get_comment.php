<?php

/*
 * This example demonstrate how to get a specific comment on a download.
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

// ID of the download to get the comment from
$download_id	= 5;

// ID of the comment to get
$comment_id	= 8;

//-----------------------------------------------------
// EXAMPLE CODE
//-----------------------------------------------------

// Get the comment
$result = $api->downloads->getComment($download_id, $comment_id);

if (!$result->isError()) {
	// Comment retrieved sucessfully
	$data = $result->getData();
	print_r($data);
} else {
	// Something is wrong . . .  Put on your DEBUG shoes
	echo $result->getErrorMessage();
}
