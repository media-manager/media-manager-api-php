<?php

/**
 * External API Tests.
 */
class ExternalAPITest extends PHPUnit_Framework_TestCase
{

    /**
     * Create a mock CurlRequest that returns given string data for doRequest.
     * @param string $requestResponse The string to be returned by response.
     * @return MediaManager\HTTP\CurlRequest
     */
    private function getMockRequest($requestResponse)
    {
        $request = $this->getMockBuilder("MediaManager\HTTP\CurlRequest")
            ->setConstructorArgs(array("www.example.com"))
            ->getMock();

        $request->expects($this->any())
            ->method('getData')
            ->will($this->returnValue(array()));

        $request->expects($this->any())
            ->method("doRequest")
            ->will($this->returnValue($requestResponse));

        return $request;
    }

    /**
     * Test external API object.
     */
    public function testExternalObject()
    {

        $request = $this->getMockRequest('{"foo": "bar"}');

        $API = new \MediaManager\API\External("foo", "bar", $request);

        $this->assertTrue(is_array($API->getTemplateMostViewedVideos('template')));
        $this->assertTrue(is_array($API->recommendTemplateVideo('template', "video")));
        $this->assertTrue(is_array($API->getTemplateLatestVideos('template')));
        $this->assertTrue(is_array($API->searchTemplateVideos('template', array("term"))));
        $this->assertTrue(is_array($API->getPlaylistAudioOnTemplate('playlist', 'template', 'audioid')));
        $this->assertTrue(is_array($API->getPlaylistAudiosOnTemplate('playlist', 'template')));
        $this->assertTrue(is_array($API->getPlaylistVideoOnTemplate('playlist', 'template', 'videoid')));
        $this->assertTrue(is_array($API->getPlaylistVideosOnTemplate('playlist', 'template')));
        $this->assertTrue(is_array($API->getTemplateAudios('template')));
        $this->assertTrue(is_array($API->getTemplateVideo('template', "videoid")));
        $this->assertTrue(is_array($API->getTemplateVideos('template')));
    }

    /**
     * Teardown things that need to be removed like the sitemap.xml file 
     * after test.
     */
    public function tearDown()
    {
        parent::tearDown();

        //Remove the sitemap.xml
        if (file_exists("sitemap.xml")) {
            unlink("sitemap.xml");
        }
    }

    /**
     * Test generating of xml sitemap based on template content.
     */
    public function testTemplateSitemap()
    {

        $request = $this->getMockRequest('{"total": 0, "per_page": 10, "current_page": 1, "last_page": 2, "from": 0, "to": 0, "data": []}');
        $API = new \MediaManager\API\External("foo", "bar", $request);

        //Test the generating of sitemap.
        $API->generateTemplateSitemap("templateid");

        //Asset the sitemap file was generated.
        $this->assertFileExists("sitemap.xml");
    }
}
