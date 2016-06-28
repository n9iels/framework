<?php
$app->get('/fietstrommels[/{deelgemeente}]', function ($request, $response, $args)
{
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

    return $request->withjson($list);
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


$app->get('/biketheft', function($request, $response, $args)
{
    if ($request->getHeader('ETag')[0] == 'test') {
        return $this->cache->withEtag($response, "e3b334731bb91170e9c7247ffb10b0e5")->withStatus(304);
    }

    $db = \Libraries\Factory::getDbo();

    $query = $db->getQuery();
    $query-> select("*")
        ->from($db->quoteName("BikeTheft"));

    $db->setQuery($query);
    $db->execute();

    $list = $db->fetchArray();

    $db->close();

    return $this->cache->withEtag($response, "e3b334731bb91170e9c7247ffb10b0e5")->withjson($list);
});
