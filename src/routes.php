<?php
// Routes

$app->get('/content/[{id}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info(sprintf("Requested content via /content/", $args['id']));

	$db = \Libraries\Factory::getDbo();

	// Build query
	$query = $db->getQuery();
	$query->select("title")->from("jos_content")->where("id = " . $args['id']);

	// Set query
	$db->setQuery($query);
	$db->execute();
	$list = $db->fetchArray();

    // Render index view
    return json_encode($list);

});
