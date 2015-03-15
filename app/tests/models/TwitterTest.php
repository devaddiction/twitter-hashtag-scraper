<?php

require __DIR__ . '/../../vendor/autoload.php';

class TwitterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Object of Twitter class
     *
     * @var \Twitter\Hashtag\Scraper\Twitter
     */
    protected $twitterObject;

    /**
     * Setup the environment before running tests
     */
    public function setUp()
    {
        $this->twitterObject = new \Twitter\Hashtag\Scraper\Twitter();
    }

    /**
     * To test the protected method using the reflection class
     *
     * @param string $name Name of the class
     * @return ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new ReflectionClass('\\Twitter\Hashtag\Scraper\\Twitter');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * Test if the maxId is processed as per int size
     */
    public function testMaxIdIsProcessed()
    {
        $processMaxId = self::getMethod('processMaxId');
        $newId = $processMaxId->invokeArgs(new \Twitter\Hashtag\Scraper\Twitter(), array(1));
        if (PHP_INT_SIZE === 8) {
            $this->assertEquals(0, $newId);
        } else {
            $this->assertEquals('1', $newId);
        }
    }

}