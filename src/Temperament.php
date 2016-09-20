<?php
    class Temperament
    {
        private $id;
        private $description;

        function __construct($description, $id = null)
        {
            $this->id = $id;
            $this->description = $description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO temperaments (description) VALUES ('{$this->getDescription()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAllAnimals($temperament)
        {
            $search_temperament = $GLOBALS['DB']->query("SELECT * FROM temperaments WHERE description = '{$temperament}';");
            $temperament_id = null;
            foreach($search_temperament as $type) {
                $temperament_id = $type['id'];
            }
            $animals = Animal::getAll();
            $animals_of_temperament = array();
            foreach ($animals as $animal) {
                if ($animal->getTemperamentId() == $temperament_id) {
                    array_push($animals_of_temperament, $animal);
                }
            }
            return $animals_of_temperament;
        }

        static function getAll()
        {
            $temperament = $GLOBALS['DB']->query("SELECT * FROM temperaments");
            $all_temperament = array();
            foreach($temperament as $type) {
                $description = $type['description'];
                $id = $type['id'];
                array_push($all_temperament, new Temperament($description, $id));
            }
            return $all_temperament;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM temperaments");
        }

        function getId()
        {
            return $this->id;
        }

    }
 ?>
