<?php

class APITest extends PHPUnit_Framework_TestCase
{
    /**
     * Create a mock CurlRequest that returns given string data for doRequest.
     *
     * @param string $requestResponse The string to be returned by response.
     *
     * @return MediaManager\HTTP\CurlRequest
     */
    private function getMockRequest($requestResponse)
    {
        $request = $this->getMockBuilder("MediaManager\HTTP\CurlRequest")
            ->setConstructorArgs(['www.example.com'])
            ->getMock();

        $request->expects($this->any())
            ->method('getData')
            ->will($this->returnValue([]));

        $request->expects($this->any())
            ->method('doRequest')
            ->will($this->returnValue($requestResponse));

        return $request;
    }

    /**
     * Test the actual API object.
     */
    public function testAPIObject()
    {
        $request = $this->getMockRequest('{"foo": "bar"}');

        $API = new \MediaManager\API\API('foo', 'bar', $request);

        //Assert instance of analytics method is correct.
        $this->assertInstanceOf("MediaManager\Analytics\Analytics", $API->analytics());

        //Assert intance is correct.
        $this->assertInstanceOf("MediaManager\HTTP\HTTP", $API->getHTTP());

        //Test adding of global filters
        $API->addFilter('foo', 'bar');
        $this->assertEquals(['foo' => 'bar', '_apikey' => 'bar'], $API->getHTTP()->getGlobalParams());

        //Add the playlist filter
        $API->addPlaylistFilter('playlist');
        $this->assertEquals(['foo' => 'bar', '_apikey' => 'bar', 'playlist' => 'playlist'], $API->getHTTP()->getGlobalParams());

        //Add the template filter.
        $API->addTemplateFilter('template');
        $this->assertEquals(['foo' => 'bar', '_apikey' => 'bar', 'playlist' => 'playlist', 'templateID' => 'template'], $API->getHTTP()->getGlobalParams());
    }

    /**
     * Testing of getting client.
     */
    public function testGetAPIs()
    {

        //Setup mock request with return data.
        $request = $this->getMockRequest('{"total": 0, "per_page": 10, "current_page": 1, "last_page": 2, "from": 0, "to": 0, "data": []}');

        //Create api object.
        $API = new \MediaManager\API\API('foo', 'bar', $request);

        //Assert an array is returned.
        $this->assertTrue(is_array($API->getClient()));
        $this->assertTrue(is_array($API->getTemplates()));
        $this->assertTrue(is_array($API->getVideo('video')));
        $this->assertTrue(is_array($API->getPlaylists()));

        $this->assertInstanceOf("MediaManager\Pager\Pager", $API->getVideos());
    }
}
