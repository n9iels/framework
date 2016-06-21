<?php
// Routes

$app->get('/content/[{id}]', function ($request, $response, $args)
{
	// Get Database object
	$db = \Libraries\Factory::getDbo();

	// Build query
	$query = $db->getQuery();
	$query->select("title")->from("jos_content")->where("id = " . $args['id']);

	// Set query
	$db->setQuery($query);
	$db->execute();

	// Execute query and get result as array
	$list = $db->fetchArray();

    // Return result as json array
    return json_encode($list);
});
