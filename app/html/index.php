<?php

/**
 * Include the composer autoloader
 */
require '../vendor/autoload.php';
use \Slim\Slim;
/**
 * Register the slim auto loader classes
 */
\Slim\Slim::registerAutoloader();
/**
 * Create and config a new Slim object
 */
$app = new Slim(array(
    'debug' => true,
    'templates.path' => '../src/views'
));
/**
 * Route for home page
 */
$app->get('/', function() use ($app) {
    // Render the index.php view
    $app->render('index.php');
});
/**
 * Route for API request
 */
$app->get('/fetch', function() use($app) {
    // Extract the get parameters from request
    $maxId = $app->request()->get('max_id');
    $twitter = new \Twitter\Hashtag\Scraper\Twitter();
    // Return tweets in json format on success
    echo json_encode((array)$twitter->getTweets($maxId));
});
/**
 * Run the application
 */
$app->run();