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
$query->select("title")->from("jos_content")->where("id = '100'")->where("id = '200'");

// Set query
$driver->setQuery($query);
$driver->execute();
echo "<pre>" . print_r($query->__toString(), true) . "</pre>";

$list = $driver->fetchObjectList();
echo "<pre>" . print_r($list, true) . "</pre>";