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

        function __construct($species_id, $name, $gender, $age, $weight, $breed_id, $color, $months_in_shelter, $temperament_id, $id)
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
