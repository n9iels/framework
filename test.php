<?php
spl_autoload_register(function ($class_name) {
	$path = preg_split('/(?=[A-Z])/', $class_name);

	require_once 'framework/' . strtolower(implode('/', $path) . '.php');
});

$db = Factory::getDbo();
$query = $db->getQuery();
$query->select("id, name");
$query->from("sand_users");

$db->setQuery($query);
$db->execute();
