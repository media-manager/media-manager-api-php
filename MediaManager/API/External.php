<?php

namespace MediaManager\API;

/**
 * Description of External
 *
 * @author Dale
 */
class External extends API {

    public function __construct($client, $apiKey, $version = 1) {
        parent::__construct($client, $apiKey, $version);
    }

    /**
     * Get most viewed videos on given template
     * @return type
     */
    public function getTemplateMostViewedVideos($template) {

        $api = "/external/template/" . $template . "/videos/mostviewed";

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

    /**
     * Get most viewed videos on given template
     * @return type
     */
    public function recommendTemplateVideo($template, $videoid) {

        $api = "/external/template/" . $template . "/videos/recommend/{$videoid}";

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

    /**
     * Get the latest videos on template
     * @param type $template
     * @return type
     */
    public function getTemplateLatestVideos($template) {

        $api = "/external/template/" . $template . "/videos/latest";

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

    /**
     * Get the latest videos on template
     * @param type $template
     * @return type
     */
    public function searchTemplateVideos($template, array $term) {

        //IF NO TERMS FOUND
        if (count($term) == 0) {
            throw new Exception("No terms passed");
        }

        //SET THE TERM PARAM
        $this->HTTP->setGlobalParams(array("term" => implode(",", $term)));

        $api = "/external/template/" . $template . "/video/search";

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

    /**
     * Get details of video on template
     * @param type $template
     * @param type $videoid
     */
    public function getTemplateVideo($template, $videoid) {

        $api = "/external/template/" . $template . "/video/{$videoid}";

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

    /**
     * Get all videos published to the external template
     * @param type $template
     * @return type
     */
    public function getTemplateVideos($template) {

        $api = "/external/template/" . $template . "/videos";

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

    /**
     * Get all audios published to external template
     * @param type $template
     * @return type
     */
    public function getTemplateAudios($template) {

        $api = "/external/template/" . $template . "/audios";

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

    /**
     * Get all videos that are published to a given playlist on a given template.
     * @param type $playlist
     * @param type $template
     * @return type
     */
    public function getPlaylistVideosOnTemplate($playlist, $template) {

        $api = "/external/playlist/{$playlist}/videos";

        //SET THE TEMPLATE ID
        $this->HTTP->setGlobalParams(array("templateID" => $template));

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

    /**
     * Get all videos that are published to a given playlist on a given template.
     * @param type $playlist
     * @param type $template
     * @return type
     */
    public function getPlaylistAudiosOnTemplate($playlist, $template) {

        $api = "/external/playlist/{$playlist}/audios";

        //SET THE TEMPLATE ID
        $this->HTTP->setGlobalParams(array("templateID" => $template));

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

    /**
     * Get all videos that are published to a given playlist on a given template.
     * @param type $playlist
     * @param type $template
     * @return type
     */
    public function getPlaylistVideoOnTemplate($playlist, $template, $videoid) {

        $api = "/external/playlist/{$playlist}/video/{$videoid}";

        //SET THE TEMPLATE ID
        $this->HTTP->setGlobalParams(array("templateID" => $template));

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

    /**
     * Get all videos that are published to a given playlist on a given template.
     * @param type $playlist
     * @param type $template
     * @return type
     */
    public function getPlaylistAudioOnTemplate($playlist, $template, $audioid) {

        $api = "/external/playlist/{$playlist}/video/{$audioid}";

        //SET THE TEMPLATE ID
        $this->HTTP->setGlobalParams(array("templateID" => $template));

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->BASE_URI . $api);

        return $response;
    }

}
