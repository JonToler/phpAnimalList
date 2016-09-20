<?php
    class Animal
    {
        private $species_id;
        private $name;
        private $gender;
        private $age;
        private $weight;
        private $breed_id;
        private $color;
        private $months_in_shelter;
        private $temperament_id;
        private $id;

        function __construct($species_id, $name, $gender, $age, $weight, $breed_id, $color, $months_in_shelter, $temperament_id, $id = null)
        {
            $this->species_id = $species_id;
            $this->name = $name;
            $this->gender = $gender;
            $this->age = $age;
            $this->weight = $weight;
            $this->breed_id = $breed_id;
            $this->color = $color;
            $this->months_in_shelter = $months_in_shelter;
            $this->temperament_id = $temperament_id;
            $this->id = $id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO animals (species_id, name, gender, age, weight, breed_id, color, months_in_shelter, temperament_id) VALUES (
                {$this->getSpeciesId()},
                '{$this->getName()}',
                '{$this->getGender()}',
                {$this->getAge()},
                {$this->getWeight()},
                {$this->getBreedId()},
                '{$this->getColor()}',
                {$this->getMonthsInShelter()},
                {$this->getTemperamentId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function sort()
        {

        }

        function deleteItem()
        {

        }

        static function getAll()
        {
            $animals = array();
            $all_animals = $GLOBALS['DB']->query("SELECT * FROM animals");
            foreach ($all_animals as $animal) {
                $species_id = $animal['species_id'];
                $name = $animal['name'];
                $gender = $animal['gender'];
                $age = $animal['age'];
                $weight = $animal['weight'];
                $breed_id = $animal['breed_id'];
                $color = $animal['color'];
                $months_in_shelter = $animal['months_in_shelter'];
                $temperament_id = $animal['temperament_id'];
                $id = $animal['id'];
                $new_animal = new Animal($species_id, $name, $gender, $age, $weight, $breed_id, $color, $months_in_shelter, $temperament_id, $id);
                array_push($animals, $new_animal);
            }
            return $animals;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM animals;");
        }









        function getSpeciesId()
        {
            return $this->species_id;
        }
        function getName()
        {
            return $this->name;
        }
        function getGender()
        {
            return $this->gender;
        }
        function getAge()
        {
            return $this->age;
        }
        function getWeight()
        {
            return $this->weight;
        }
        function getBreedId()
        {
            return $this->breed_id;
        }
        function getColor()
        {
            return $this->color;
        }
        function getMonthsInShelter()
        {
            return $this->months_in_shelter;
        }
        function getTemperamentId()
        {
            return $this->temperament_id;
        }
        function getId()
        {
            return $this->id;
        }

    }
 ?>
