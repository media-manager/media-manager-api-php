<?php

namespace MediaManager\Analytics;

/**
 * Description of Condition
 *
 * @author Dale
 */
class Condition {

    private $logical = "AND";
    private $key, $value, $operator;

    public function __construct($key, $value, $operator = "IS") {
        $this->key = $key;
        $this->value = $value;
        $this->operator = $operator;
    }

    /**
     * Set the logical
     * @param type $logical
     */
    public function Logical($logical) {
        $this->logical = $logical;
    }

    /**
     * toString method
     * @return type
     */
    public function __toString() {
        return "{" . $this->key . " " . $this->operator . " " . $this->value . "}";
    }

    /**
     * Getter
     * @param type $name
     * @return type
     */
    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

}
