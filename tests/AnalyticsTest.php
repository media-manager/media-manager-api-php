<?php

class AnalyticsTest extends PHPUnit_Framework_TestCase
{

    /**
     * The Request object (Curl).
     * @var \MediaManager\HTTP\CurlRequest 
     */
    protected $Request;

    /**
     * The HTTP Object.
     * @var \MediaManager\HTTP\HTTP 
     */
    protected $Http;

    /**
     * Setup tests
     */
    protected function setUp()
    {
        //Create a CurlRequest 
        $this->Request = new MediaManager\HTTP\CurlRequest("www.example.com");

        //Create the HTTP Request
        $this->Http = new MediaManager\HTTP\HTTP($this->Request);
    }

    /**
     * Test the analytics object.
     */
    public function testAnalyticsObject()
    {

        $Analytics = new MediaManager\Analytics\Analytics($this->Http);
        
        var_dump($Analytics);
        
        $this->assertInstanceOf("MediaManager\HTTP\HTTP", $Analytics->getHTTP());
    }
}
