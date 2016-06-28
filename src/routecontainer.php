<?php
class RouteContainer
{
    /**
     * bikeContainer route
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  array                                    $args     Request arguments
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bikeContainer($request, $response, $args)
    {
        // Get Database object
        $db = \Libraries\Factory::getDbo();

        // Build query
        $query = $db->getQuery();
        $query->select("*")
            ->from($db->quoteName("fietstrommels"));

        if (isset($args['deelgemeente'])) {
            $query->where($db->quoteName("deelgemeente") . " = " . $db->quote($args['deelgemeente']));
        }

        if (isset($args['id'])) {
            $query->where($db->quoteName("trommelid") . " = " . $db->quote($args['id']));
        }

        // Set and execute query
        $db->setQuery($query);
        $db->execute();

        // Get result as array
        $list = $db->fetchArray();

        // Close connection
        $db->close();

        return $response->withJson($list);
    }

    /**
     * biekTheft route
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  array                                    $args     Request arguments
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bikeTheft($request, $response, $args)
    {
        // Get database object
        $db = \Libraries\Factory::getDbo();

        // Build query
        $query = $db->getQuery();
        $query-> select("*")
            ->from($db->quoteName("BikeTheft"));

        // Set and execute query
        $db->setQuery($query);
        $db->execute();

        // Get result as array
        $list = $db->fetchArray();

        // Close connection
        $db->close();

        return $response->withJson($list);
    }
}