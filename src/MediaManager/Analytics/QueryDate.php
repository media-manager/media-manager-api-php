<?php

namespace MediaManager\Analytics;

/**
 * A QueryDate object to make it easier to deal with dates and make sure they
 * are in the correct format for Media Manager Query.
 */
class QueryDate
{
    private $dateString;

    /**
     * The DateTime object.
     *
     * @var DateTime
     */
    private $date;

    /**
     * Create new QueryDate.
     *
     * @param type $date
     */
    public function __construct($date)
    {
        //Date passed must be a string.
        if (!is_string($date)) {
            throw new \MediaManager\Exception\InvalidDateFormatException();
        }

        //Set the string in variable.
        $this->dateString = $date;

        //Set the DateTime object.
        $this->date = new \DateTime($date);
    }

    /**
     * Get the date as a string format. Simply returns original string.
     *
     * @return type
     */
    public function __toString()
    {
        return $this->dateString;
    }

    /**
     * Return the date in a certain format.
     *
     * @param string $format
     */
    public function get($format = 'Y-m-d')
    {
        return $this->date->format($format);
    }

    /**
     * Add so many days to the date.
     *
     * @param int $noOfDays
     */
    public function addDays($noOfDays)
    {
        $this->add('P'.$noOfDays.'D');
    }

    /**
     * substract days from dat.e.
     *
     * @param int $noOfDays
     */
    public function subDays($noOfDays)
    {
        $this->sub('P'.$noOfDays.'D');
    }

    /**
     * Add to a DateTime using the DateInterval. Simply pass the string.
     * e.g P20D for 20 Days.
     *
     * @param string $intervalString
     */
    public function add($intervalString)
    {
        $this->date->add(new \DateInterval($intervalString));
    }

    /**
     * Substract from a DateTime using the DateInterval.
     *
     * @param string $intervalString
     */
    public function sub($intervalString)
    {
        $this->date->sub(new \DateInterval($intervalString));
    }
}
