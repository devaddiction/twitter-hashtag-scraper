<?php

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Class RedisTest
 * Contains tests for \Twitter\Hashtag\Scraper\Redis class
 */
class RedisTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Object of Redis class
     *
     * @var \Twitter\Hashtag\Scraper\Twitter
     */
    protected $redisObject;

    /**
     * Setup the environment before running tests
     */
    public function setUp()
    {
        $this->redisObject = new \Twitter\Hashtag\Scraper\Redis('tweet-test');

        // Add some dummy tweets
        $tweetId = 100;
        $data = array('id_str' => '100', 'text' => 'Foo', 'screen_name' => 'Bar', 'retweet_count' => '1', 'favorite_count' => '10');
        $this->redisObject->addTweet($tweetId, $data);

        $tweetId = 101;
        $data = array('id_str' => '101', 'text' => 'Baz', 'screen_name' => 'Foo', 'retweet_count' => '1', 'favorite_count' => '8');
        $this->redisObject->addTweet($tweetId, $data);

        $tweetId = 102;
        $data = array('id_str' => '102', 'text' => 'Bar', 'screen_name' => 'Baz', 'retweet_count' => '1', 'favorite_count' => '9');
        $this->redisObject->addTweet($tweetId, $data);
    }

    /**
     * Test minimum tweet id
     */
    public function testMinimumTweetId()
    {
        $this->assertEquals('100', $this->redisObject->getMinTweetId());
    }

    /**
     * Test maximum tweet id
     */
    public function testMaximumTweetId()
    {
        $this->assertEquals('102', $this->redisObject->getMaxTweetId());
    }

    /**
     * Test tweets less than a given id
     */
    public function testGetTweetsLesserThan()
    {
        $expected = array(
            array('id_str' => '101', 'text' => 'Baz', 'screen_name' => 'Foo', 'retweet_count' => '1', 'favorite_count' => '8'),
            array('id_str' => '100', 'text' => 'Foo', 'screen_name' => 'Bar', 'retweet_count' => '1', 'favorite_count' => '10')
        );

        $this->assertSame($expected, $this->redisObject->getTweetsLessThan(102, 20));
    }

    /**
     * Test total tweet count
     */
    public function testTotalTweetCount()
    {
        $this->assertEquals(3, $this->redisObject->getTotalTweetCount());
    }

    public function testClear()
    {
        $this->redisObject()->clear();
        $this->assertEquals(0, $this->redisObject->getTotalTweetCount());
    }

    /**
     * Clean up the database
     */
    public function tearDown()
    {
        $this->redisObject->deleteTweet(100);
        $this->redisObject->deleteTweet(101);
        $this->redisObject->deleteTweet(102);
    }
}