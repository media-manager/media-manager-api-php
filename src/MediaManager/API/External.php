<?php

namespace MediaManager\API;

/**
 * Description of External.
 *
 * @author Dale
 */
class External extends API
{
    /**
     * Create External API object.
     *
     * @param type                      $client
     * @param type                      $apiKey
     * @param MediaManager\HTTP\Request $request
     */
    public function __construct($client, $apiKey, $request)
    {
        parent::__construct($client, $apiKey, $request);
    }

    /**
     * Get most viewed videos on given template.
     *
     * @return type
     */
    public function getTemplateMostViewedVideos($template)
    {
        $api = '/external/template/'.$template.'/videos/mostviewed';

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get most viewed videos on given template.
     *
     * @return type
     */
    public function recommendTemplateVideo($template, $videoid)
    {
        $api = '/external/template/'.$template."/videos/recommend/{$videoid}";

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get the latest videos on template.
     *
     * @param type $template
     *
     * @return type
     */
    public function getTemplateLatestVideos($template)
    {
        $api = '/external/template/'.$template.'/videos/latest';

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get the latest videos on template.
     *
     * @param type $template
     *
     * @return type
     */
    public function searchTemplateVideos($template, array $term)
    {

        //IF NO TERMS FOUND
        if (count($term) == 0) {
            throw new Exception('No terms passed');
        }

        //SET THE TERM PARAM
        $this->HTTP->setGlobalParams(['term' => implode(',', $term)]);

        $api = '/external/template/'.$template.'/video/search';

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get details of video on template.
     *
     * @param type $template
     * @param type $videoid
     */
    public function getTemplateVideo($template, $videoid)
    {
        $api = '/external/template/'.$template."/video/{$videoid}";

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get all videos published to the external template.
     *
     * @param type $template
     *
     * @return type
     */
    public function getTemplateVideos($template)
    {
        $api = '/external/template/'.$template.'/videos';

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get all audios published to external template.
     *
     * @param type $template
     *
     * @return type
     */
    public function getTemplateAudios($template)
    {
        $api = '/external/template/'.$template.'/audios';

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get all videos that are published to a given playlist on a given template.
     *
     * @param type $playlist
     * @param type $template
     *
     * @return type
     */
    public function getPlaylistVideosOnTemplate($playlist, $template)
    {
        $api = "/external/playlist/{$playlist}/videos";

        //SET THE TEMPLATE ID
        $this->HTTP->setGlobalParams(['templateID' => $template]);

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get all videos that are published to a given playlist on a given template.
     *
     * @param type $playlist
     * @param type $template
     *
     * @return type
     */
    public function getPlaylistAudiosOnTemplate($playlist, $template)
    {
        $api = "/external/playlist/{$playlist}/audios";

        //SET THE TEMPLATE ID
        $this->HTTP->setGlobalParams(['templateID' => $template]);

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get all videos that are published to a given playlist on a given template.
     *
     * @param type $playlist
     * @param type $template
     *
     * @return type
     */
    public function getPlaylistVideoOnTemplate($playlist, $template, $videoid)
    {
        $api = "/external/playlist/{$playlist}/video/{$videoid}";

        //SET THE TEMPLATE ID
        $this->HTTP->setGlobalParams(['templateID' => $template]);

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get all videos that are published to a given playlist on a given template.
     *
     * @param type $playlist
     * @param type $template
     *
     * @return type
     */
    public function getPlaylistAudioOnTemplate($playlist, $template, $audioid)
    {
        $api = "/external/playlist/{$playlist}/video/{$audioid}";

        //SET THE TEMPLATE ID
        $this->HTTP->setGlobalParams(['templateID' => $template]);

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Generate the sitemap for template.
     *
     * @param type $template
     */
    public function generateTemplateSitemap($template, $location = '')
    {
        $this->HTTP->setGlobalParams(['perPage' => 100]);

        //GET TEMPLATE VIDEOS
        $videos = $this->getTemplateVideos($template);

        //THE VIDEO URL XML.
        $videoURLXML = file_get_contents(__DIR__.'/../MediaManager/Templates/video-sitemap-url.xml');

        //BUILD THE XML STRING.
        $videoXML = '';

        foreach ($videos['data'] as $video) {

            //SET THE LOCATION
            $video['location'] = 'https://'.$this->client.'.getmediamanager.com/video/'.$video['_id'];
            $video['playerlocation'] = $video['location'].'?autoplay=false';
            $video['filelocation'] = $video['videoFiles']['http']['mp4']['360'];

            //SET THE URL ROW
            $urlRow = $videoURLXML;

            $keys = array_keys($video);

            foreach ($keys as $key) {
                if (is_string($video[$key]) || is_numeric($video[$key])) {
                    $urlRow = str_replace('{'.$key.'}', htmlspecialchars($video[$key]), $urlRow);
                }
            }

            $videoXML .= $urlRow;
        }

        $videoURLXML = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">';
        $videoURLXML .= $videoXML;
        $videoURLXML .= '</urlset>';

        file_put_contents("{$location}sitemap.xml", $videoURLXML);
    }
}
