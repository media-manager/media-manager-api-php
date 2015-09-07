<?php

namespace MediaManager\Analytics;

/**
 * Description of Query
 *
 * @author Dale
 */
class Query {

    private $Show;

    public function __construct() {
        //SET THE DEFAULT SHOW
        $this->Show = new Show("Video");
    }

    /**
     * Set query SHOW.
     * @param string $show
     * @return \MediaManager\Analytics\Show
     */
    public function Show($show) {
        $this->Show = new Show($show);
        return $this->Show;
    }

    /**
     * To String method
     * @return string
     */
    public function __toString() {
        return "" . $this->Show;
    }

}
