<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/etagvalidation.php';
require __DIR__ . '/../src/routecontainer.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Register service provider with the container
$container = new \Slim\Container;
$container['cache'] = function () {
    return new \Slim\HttpCache\CacheProvider();
};

// Add middleware to the application
$app = new \Slim\App($container);
$app->add(new \Slim\HttpCache\Cache('public', 60));
$app->add(new ETagValidation($container));

// Register routes
$app->get('/fietstrommels[/{deelgemeente}[/{id}]]', 'routeContainer:bikeContainer');
$app->get('/biketheft', 'routeContainer:biketheft');

// Run app
$app->run();
