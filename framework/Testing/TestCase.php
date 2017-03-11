<?php
/**
 * User: macro chen <macro_fengye@163.com>
 * Date: 2017/3/11
 * Time: 21:08
 */

namespace Polymer\Testing;

use GuzzleHttp\Client;
use Polymer\Boot\Application;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Application
     */
    protected $app;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->app = app();
        $this->client = new Client($this->app->config('testing.config', []));
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->app = null;
        $this->client = null;
    }
}