<?php
$app->get('/fietstrommels[/{deelgemeente}]', function ($request, $response, $args)
{
    // Get Database object
    $db = \Libraries\Factory::getDbo();

    // Build query
    $query = $db->getQuery();
    $query->select("*")->from($db->quoteName("fietstrommels"));

    if (isset($args['deelgemeente']))
    {
        $query->where($db->quoteName("deelgemeente") . " = " . $db->quote($args['deelgemeente']));
    }

    // Set query
    $db->setQuery($query);
    $db->execute();

    // Execute query and get result as array
    $list = $db->fetchArray();

    // Close connection
    $db->close();

    return $response->withjson($list);
});

$app->get('/fietstrommels/{deelgemeente}/{id}', function ($request, $response, $args)
{
    // Get Database object
    $db = \Libraries\Factory::getDbo();

    // Build query
    $query = $db->getQuery();
    $query->select("*")
        ->from($db->quoteName("fietstrommels"))
            ->where($db->quoteName("deelgemeente") . " = " . $db->quote($args['deelgemeente']))
            ->where($db->quoteName("trommelid") . " = " . $db->quote($args['id']));

    // Set query
    $db->setQuery($query);
    $db->execute();

    // Execute query and get result as array
    $list = $db->fetchArray();

    // Close connection
    $db->close();

    return $response->withjson($list);
});