<?php

namespace MediaManager\Pager;

/**
 * Description of Pager.
 *
 * @author Dale
 */
class Pager implements \Iterator
{

    private $total;
    private $per_page;
    private $current_page;
    private $last_page;
    private $from;
    private $to;
    private $data;
    private $position = 0;

    public function __construct(array $pageData)
    {   
        if (isset($pageData["total"])) {
            throw Exception("Invalid pager data", 400);
        }

        $this->total = $pageData['total'];
        $this->per_page = $pageData['per_page'];
        $this->current_page = $pageData['current_page'];
        $this->last_page = $pageData['last_page'];
        $this->from = $pageData['from'];
        $this->to = $pageData['to'];
        $this->data = $pageData['data'];
    }

    /**
     * Go back to start.
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Get current item.
     *
     * @return type
     */
    public function current()
    {
        return $this->data[$this->position];
    }

    /**
     * Get the key.
     *
     * @return type
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Move to next position.
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Check if item is valid based on position.
     *
     * @return type
     */
    public function valid()
    {
        return isset($this->data[$this->position]);
    }

    /**
     * Getter function.
     *
     * @param type $property
     *
     * @return type
     */
    public function __get($property)
    {
        if ($property == 'items') {
            return $this->data;
        }

        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}
