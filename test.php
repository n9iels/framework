<?php
spl_autoload_register(function ($class_name) {
	$path = 'framework' . strtolower(implode(DIRECTORY_SEPARATOR, preg_split('/(?=[A-Z])/', $class_name)));
	$file = $path . '.php';

	if (file_exists($file)) {
		require_once $file;
	} else {
		require_once $path . DIRECTORY_SEPARATOR . strtolower($class_name) . '.php';
	}
});

$db = Factory::getDbo();
$query = $db->getQuery();
$query->select("id, name");
$query->from("#__users");
$query->where("id = '3'");

$db->setQuery($query);
$db->execute();
