<?php
define('BASE_PATH', __DIR__);
define('FRAMEWORK_BASE', BASE_PATH . '/framework/');

require_once 'framework/loader.php';

spl_autoload_register(function ($class_name) {
	Loader::load($class_name);
});

$db = Factory::getDbo();
$query = $db->getQuery();
$query->select("id, name");
$query->from("#__users");
$query->where("id = '3'");

$db->setQuery($query);
$db->execute();
