<?php
    class Species
    {
        private $id;
        private $description;

        function __construct($id, $description)
        {
            $this->id = $id;
            $this->description = $description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getAllAnimals()
        {

        }
    }
 ?>
