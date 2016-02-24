<?php
use MediaManager\HTTP\HTTP as HTTP;

/**
 * External API Tests.
 */
class HTTPTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test setting of global parameters.
     */
    public function testSetGlobalParams()
    {
        $CurlRequest = new MediaManager\HTTP\CurlRequest('http://www.example.com');

        //Create HTTP Object
        $HTTPObject = new HTTP($CurlRequest);

        //Expected results
        $expected = ['foo' => 'bar'];

        //Set the global params
        $HTTPObject->setGlobalParams($expected);

        //Assert the setting of global params is correct.
        $this->assertEquals($expected, $HTTPObject->getGlobalParams());
    }

    /**
     * Test the basis auth object.
     */
    public function testBasicAuthObject()
    {
        //The BasicAuth object
        $BasicAuth = new \MediaManager\HTTP\BasicAuth('foo', 'bar');

        //Assert username and password are correct.
        $this->assertEquals($BasicAuth->getUsername(), 'foo');
        $this->assertEquals($BasicAuth->getPassword(), 'bar');

        //Set the username and password
        $BasicAuth->setUsername('bar');
        $BasicAuth->setPassword('foo');

        //Assert they are true.
        $this->assertEquals('bar', $BasicAuth->getUsername());
        $this->assertEquals('foo', $BasicAuth->getPassword());
    }

    /**
     * Test the CurlRequest object.
     */
    public function testCurlRequestObject()
    {

        //GET CurlRequest
        $CurlRequestGET = new MediaManager\HTTP\CurlRequest('http://www.example.com', 'GET');

        //Assert URL is returned correctly.
        $this->assertEquals('http://www.example.com', $CurlRequestGET->getURL());

        //Set the request data
        $CurlRequestGET->setData(['fo' => 'bar']);
        $this->assertEquals(['fo' => 'bar'], $CurlRequestGET->getData());

        //Set sending file
        $CurlRequestGET->sendFile(true);
        $this->assertEquals(true, $CurlRequestGET->isSendingFile());

        //Set the headers
        $CurlRequestGET->setHeaders(['Content-Type: application/json']);
        $this->assertEquals(['Content-Type: application/json'], $CurlRequestGET->getHeaders());

        //Check type is still GET.
        $this->assertEquals('GET', $CurlRequestGET->getType());
        //Update the request type to POST.
        $CurlRequestGET->setType('POST');
        //Assert true.
        $this->assertEquals('POST', $CurlRequestGET->getType());

        //New BasicAuth object.
        $basicAuth = new MediaManager\HTTP\BasicAuth('foo', 'bar');

        //Set the basic auth.
        $CurlRequestGET->setAuth($basicAuth);

        //Check BasicAuth is returned
        $this->assertInstanceOf("MediaManager\HTTP\BasicAuth", $CurlRequestGET->getBasicAuth());

    }

    /**
     * Test the JsonResponse Object.
     */
    public function testJsonResponseObject()
    {
        //New json response
        $JsonObject = new MediaManager\HTTP\JsonResponse('{"foo": "bar"}');

        //Assert toString returns correctly.
        $this->assertEquals('{"foo": "bar"}', $JsonObject->toString());

        //SHould be no errors.
        $this->assertNotTrue($JsonObject->hasErrors());

        //Check the array generated is correct.
        $this->assertEquals(['foo' => 'bar'], $JsonObject->toArray());

        //Set the json string
        $JsonObject->setJson('{"bar": "foo"}');
        $this->assertEquals('{"bar": "foo"}', $JsonObject->toString());

        //Set error message within json response.
        $JsonObject->setJson('{"error": {"message": "Foo bar error"}}');

        //Assert hasErrors.
        $this->assertTrue($JsonObject->hasErrors());
        $this->assertEquals('Foo bar error', $JsonObject->getErrorMessage());

        //Set error message within json response.
        $JsonObject->setJson('{"error": "Invalid error format"}');
        $this->assertEquals('Unknown', $JsonObject->getErrorMessage());
    }
}
