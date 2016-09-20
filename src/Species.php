<?php
    class Species
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
            $GLOBALS['DB']->exec("INSERT INTO species (description) VALUES ('{$this->getDescription()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAllAnimals($species)
        {
            $search_species = $GLOBALS['DB']->query("SELECT * FROM species WHERE description = '{$species}';");
            $species_id = null;
            foreach($search_species as $type) {
                $species_id = $type['id'];
            }
            $animals = Animal::getAll();
            $animals_of_species = array();
            foreach ($animals as $animal) {
                if ($animal->getSpeciesId() == $species_id) {
                    array_push($animals_of_species, $animal);
                }
            }
            return $animals_of_species;
        }

        static function getAll()
        {
            $species = $GLOBALS['DB']->query("SELECT * FROM species");
            $all_species = array();
            foreach($species as $type) {
                $description = $type['description'];
                $id = $type['id'];
                array_push($all_species, new Species($description, $id));
            }
            return $all_species;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM species");
        }

        static function findId($description)
        {
            $species = Species::getAll();
            foreach($species as $type) {
                if ($type->getDescription() == $description) {
                    return $type->getId();
                }
            }
            $new_species = new Species($description);
            $new_species->save();
            return $new_species->getId();
        }

        static function findById($id)
        {
            $species = Species::getAll();
            foreach ($species as $type) {
                if ($type->getId == $id) {
                    return $this->getDescription;
                }
            }
        }

        function getId()
        {
            return $this->id;
        }

    }
 ?>
