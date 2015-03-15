<?php

/**
 * Include the composer autoloader
 */
require '../vendor/autoload.php';

/**
 * Prefetch tweets in all the executions
 */
$twitter = new \Twitter\Hashtag\Scraper\Twitter();
$redis = new \Twitter\Hashtag\Scraper\Redis();

$twitter->fetchAndCache(null, $redis->getMaxTweetId());