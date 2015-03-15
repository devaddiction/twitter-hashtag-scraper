<?php

namespace Twitter\Hashtag\Scraper;

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Class Authenticate
 *
 * Initializes the connection for making requests
 * to twitter API
 *
 * @package Twitter\Hashtag\Scraper
 */
class Authenticate
{
    /**
     * Contains the sensitive API information
     *
     * @var mixed Array containing API secrets
     */
    private $config;

    /**
     * Constructor
     *
     * Initialize the $config variable
     */
    public function __construct()
    {
        $this->config = include(dirname(__FILE__). '/../config/config.php');
    }

    /**
     * Creates object to interact with twitter API
     *
     * @return TwitterOAuth connection object
     */
    public function getConnection()
    {
        return new TwitterOAuth(
            $this->config['customerKey'],
            $this->config['customerSecret'],
            $this->config['accessToken'],
            $this->config['accessTokenSecret']
        );
    }
}