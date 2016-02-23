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
     * Setup anything needed for the tests.
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

        //Create Analytics object
        $Analytics = new MediaManager\Analytics\Analytics($this->Http);

        //Assert HTTP object is returned correctly.
        $this->assertInstanceOf("MediaManager\HTTP\HTTP", $Analytics->getHTTP());
    }

    /**
     * Test the QueryDate object
     */
    public function testQueryDateObject()
    {
        //The QueryDate
        $QueryDate = new MediaManager\Analytics\QueryDate("23-02-2016");

        //Check the default get
        $this->assertEquals("2016-02-23", $QueryDate->get());

        //Check setting of format works.
        $this->assertEquals("23-02-2016", $QueryDate->get("d-m-Y"));

        //Add 2 days
        $QueryDate->addDays(2);
        $this->assertEquals("25-02-2016", $QueryDate->get("d-m-Y"));

        //Remove two days.
        $QueryDate->subDays(4);
        $this->assertEquals("21-02-2016", $QueryDate->get("d-m-Y"));
    }

    /**
     * Test the condition object
     */
    public function testConditionObject()
    {
        $Condtion = new \MediaManager\Analytics\Condition("foo", "bar");

        //Test key is correct
        $this->assertEquals("foo", $Condtion->getKey());
        $this->assertEquals("bar", $Condtion->getValue());
        $this->assertEquals("IS", $Condtion->getOperator());

        //Test setting operator via constructor.
        $Condtion2 = new \MediaManager\Analytics\Condition("bar", "fod", "ISNOT");

        //Check operator is correct.
        $this->assertEquals("ISNOT", $Condtion2->getOperator());
        
        //Test setting of key.
        $Condtion2->setKey("bar");
        $this->assertEquals("bar", $Condtion2->getKey());
            
        //Test setting of value.
        $Condtion2->setValue("foo");
        $this->assertEquals("foo", $Condtion2->getValue());
            
        //Test setting of operator
        $Condtion2->setOperator("IS");
        $this->assertEquals("IS", $Condtion2->getOperator());
        
        //Test setting of operator
        $Condtion2->Logical("AND");
        $this->assertEquals("AND", $Condtion2->getLogical());
    }
}
