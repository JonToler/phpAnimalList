<?php
    class Breed
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
            $GLOBALS['DB']->exec("INSERT INTO breeds (description) VALUES ('{$this->getDescription()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAllAnimals($breed)
        {
            $search_breed = $GLOBALS['DB']->query("SELECT * FROM breeds WHERE description = '{$breed}';");
            $breed_id = null;
            foreach($search_breed as $breed) {
                $breed_id = $breed['id'];
            }
            $animals = Animal::getAll();
            $animals_of_breed = array();
            foreach ($animals as $animal) {
                if ($animal->getBreedId() == $breed_id) {
                    array_push($animals_of_breed, $animal);
                }
            }
            return $animals_of_breed;
        }

        static function getAll()
        {
            $breeds = $GLOBALS['DB']->query("SELECT * FROM breeds");
            $all_breeds = array();
            foreach($breeds as $breed) {
                $description = $breed['description'];
                $id = $breed['id'];
                array_push($all_breeds, new Breed($description, $id));
            }
            return $all_breeds;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM breeds");
        }

        function getId()
        {
            return $this->id;
        }

    }
 ?>
