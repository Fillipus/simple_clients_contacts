
<?php
// Person base class
class Person {
    private $name;

    // Constructor to initialize the name
    public function __construct($name) {
        $this->name = $name;
    }

    // Public method to set the name
    public function setName($name) {
        $this->name = $name;
    }

    // Public method to get the name
    public function getName() {
        return $this->name;
    }
}

?>