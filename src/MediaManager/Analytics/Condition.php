<?php

namespace MediaManager\Analytics;

/**
 * Description of Condition.
 *
 * @author Dale
 */
class Condition
{

    private $logical = 'AND';
    private $key, $value, $operator;

    public function __construct($key, $value, $operator = 'IS')
    {
        $this->key = $key;
        $this->value = $value;
        $this->operator = $operator;
    }

    /**
     * Set the logical.
     *
     * @param type $logical
     */
    public function Logical($logical)
    {
        $this->logical = $logical;
    }

    /**
     * toString method.
     *
     * @return type
     */
    public function __toString()
    {
        return '{' . $this->key . ' ' . $this->operator . ' ' . $this->value . '}';
    }

    /**
     * Get the key of condition.
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the key of condition.
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the condition operator (e.g IS, ISNOT).
     * @return type
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Get the logical operator, which is used to seperate conditions.
     * (e.g AND, OR).
     * @return type
     */
    public function getLogical()
    {
        return $this->logical;
    }

    /**
     * Set the operator
     * @param type $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * Set the key
     * @param type $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }
}
