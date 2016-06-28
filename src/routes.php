<?php
$app->get('/fietstrommels[/{deelgemeente}]', function ($request, $response, $args)
{
    echo "<pre>" . print_r($request->getHeader('ETag'), true) . "</pre>";
    
    // Get Database object
    $db = \Libraries\Factory::getDbo();

    // Build query
    $query = $db->getQuery();
    $query->select("*")->from($db->quoteName("fietstrommels"));

    if (isset($args['deelgemeente'])) {
        $query->where($db->quoteName("deelgemeente") . " = " . $db->quote($args['deelgemeente']));
    }

    // Set query
    $db->setQuery($query);
    $db->execute();

    // Execute query and get result as array
    $list = $db->fetchArray();

    // Close connection
    $db->close();

    return $this->cache->withEtag($response, "e3b334731bb91170e9c7247ffb10b0e5")->withStatus(304)->withjson($list);
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