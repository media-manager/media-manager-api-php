<?php

namespace MediaManager\Analytics;

/**
 * A Show object as part of the MMQL.
 */
class Show
{
    /**
     * The SHOW value, defaults to Video.
     *
     * @var type
     */
    private $show = 'Video';

    /**
     * An array of conditions.
     *
     * @var array
     */
    private $conditions = [];

    /**
     * Create new Show Object.
     *
     * @param string $show The SHOW value as a string. (e.g Video, Template).
     */
    public function __construct($show)
    {
        $this->show = $show;
    }

    /**
     * Add a new condition to Show object.
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     *
     * @return \MediaManager\Analytics\Condition
     */
    public function Condition($key, $value, $operator = 'IS')
    {
        $condition = new Condition($key, $value, $operator);
        $this->conditions[] = $condition;

        return $condition;
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
     * Convert SHOW object to MMQL string.
     *
     * @return string
     */
    public function __toString()
    {
        //THE QUERY
        $query = 'SHOW '.$this->show;

        //IF HAS CONDITIONS
        if (!empty($this->conditions)) {
            $query .= ' WHERE ';

            foreach ($this->conditions as $index => $condition) {
                $query .= $condition;

                if (isset($this->conditions[$index + 1])) {
                    $query .= ' '.$condition->logical.' ';
                }
            }
        }

        return $query;
    }
}
