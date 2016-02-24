<?php

class MediaManagerTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Test the Media Manager object. 
     */
    public function testMediaManagerObject()
    {   
        //The CurlRequest.
        $CurlRequest = new MediaManager\HTTP\CurlRequest("www.example.com");
        
        //Create MediaManager instance.
        $MediaManager = new MediaManager\MediaManager('foo', 'bar', $CurlRequest);
        
        $this->assertEquals("bar", $MediaManager->getAPIKey());
        $this->assertEquals("foo", $MediaManager->getClient());
        
        //Test that instance returned by api function returns correct.
        $this->assertInstanceOf("MediaManager\API\API", $MediaManager->api());
        
        //Test that instance returned by external function returns correct.
        $this->assertInstanceOf("MediaManager\API\External", $MediaManager->external());
    }
}
