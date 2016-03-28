<?php
define('PATH_BASE', __DIR__);
define('FRAMEWORK_BASE', PATH_BASE . '/libraries/framework');
define('APPLICATION_BASE', PATH_BASE . '/applications');

require_once FRAMEWORK_BASE . '/loader.php';

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

require_once 'applications/content/controllers/article.php';
$content = new ContentControllerArticle();
