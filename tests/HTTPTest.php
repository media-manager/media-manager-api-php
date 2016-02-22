<?php
use MediaManager\HTTP\HTTP as HTTP;

/**
 * External API Tests
 */
class HTTPTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test setting of global parameters.
     */
    public function testSetGlobalParams()
    {
        //Create HTTP Object
        $HTTPObject = new HTTP();

        //Expected results
        $expected = array("foo" => "bar");

        //Set the global params
        $HTTPObject->setGlobalParams($expected);
        
        //Assert the setting of global params is correct.
        $this->assertEquals($expected, $HTTPObject->getGlobalParams());
    }
}
