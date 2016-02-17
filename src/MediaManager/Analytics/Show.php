<?php

namespace MediaManager\Analytics;

/**
 * Description of Show.
 *
 * @author Dale
 */
class Show
{
    private $show = 'Video';
    private $conditions = [];

    public function __construct($show)
    {
        $this->show = $show;
    }

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
     * The toString method.
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
