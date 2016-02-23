<?php

namespace MediaManager\Analytics;

/**
 * A Query object which can be used to generate MMQL.
 */
class Query
{

    /**
     * The to and from dates.
     * @var \MediaManager\Analytics\QueryDate 
     */
    private $to, $from;

    /**
     * The Show object.
     *
     * @var Show;
     */
    private $Show;

    /**
     * 
     */
    public function __construct()
    {
        //Set the default show query
        $this->Show = new Show('Video');

        //Set from date to now.
        $this->from = new \MediaManager\Analytics\QueryDate("now");

        //Set to date to now.
        $this->to = new \MediaManager\Analytics\QueryDate("now");
    }

    /**
     * Set query SHOW.
     *
     * @param string $show
     *
     * @return \MediaManager\Analytics\Show
     */
    public function Show($show)
    {
        $this->Show = new Show($show);

        return $this->Show;
    }

    /**
     * Get the Show Query.
     * @return Show
     */
    public function get()
    {
        return $this->Show;
    }

    /**
     * Get the Show Query.
     * @return Show
     */
    public function getSow()
    {
        return $this->get();
    }

    /**
     * Set the from date
     * @param \MediaManager\Analytics\QueryDate $from
     */
    public function setFrom(\MediaManager\Analytics\QueryDate $from)
    {
        $this->from = $from;
    }

    /**
     * Set the to date.
     * @param \MediaManager\Analytics\QueryDate $to
     */
    public function setTo(\MediaManager\Analytics\QueryDate $to)
    {
        $this->to = $to;
    }

    /**
     * Get the from QueryDate
     * @return \MediaManager\Analytics\QueryDate
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Get the to QueryDate
     * @return \MediaManager\Analytics\QueryDate
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Getter.
     *
     * @param type $name
     *
     * @return type
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    /**
     * To String method.
     *
     * @return string
     */
    public function __toString()
    {
        return '' . $this->Show;
    }
}
