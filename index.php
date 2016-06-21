<?php
require_once "loader.php";

$loader = new Loader;
$loader->register();
$loader->addNamespace("Database\\", "Database");

$options = array (
    "driver" => "mysqli",
    "host" => "localhost",
    "user" => "root",
    "password" => "root",
    "database" => "joomla-cms"
);

// Get database and driver
$db = new \Database\Database();
$driver = $db->getDriverInstance($options);

// Build query
$query = $driver->getQuery();
$query->select("title")->from("jos_content");

// Set query
$driver->setQuery($query);
$driver->execute();

$list = $driver->fetchObjectList();
echo "<pre>" . print_r($list, true) . "</pre>";