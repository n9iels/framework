<?php
$app->get('/content', function ($request, $response, $args)
{
    // Get Database object
    $db = \Libraries\Factory::getDbo();

    // Build query
    $query = $db->getQuery();
    $query->select($db->quoteName("title"))->from($db->quoteName("jos_content"))->where($db->quote("id"));

    // Set query
    $db->setQuery($query);
    $db->execute();

    // Execute query and get result as array
    $list = $db->fetchArray();

    return $response->withjson($list);
});
