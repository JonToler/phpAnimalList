<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    **/

    require_once "src/Breed.php";
    require_once "src/Animal.php";

    $server = 'mysql:host=localhost;dbname=shelter_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BreedTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Breed::deleteAll();
            Animal::deleteAll();
        }

        function test_getAllAnimals()
        {
            //Arrange
            $test_Breed = new Breed("beagle");
            $test_Breed2 = new Breed("husky");
            $test_Breed->save();
            $test_Breed2->save();
            $test_animal = new Animal(2, 'Hank', 'Male', 7, 32, $test_Breed->getId(), 'Black', 3, 2);
            $test_animal2 = new Animal(3, 'Bill', 'Male', 8, 23, $test_Breed->getId(), 'Black', 2, 4);
            $test_animal3 = new Animal(4, 'Chloe', 'Female', 7, 14, $test_Breed2->getId(), 'Red', 6, 3);
            $test_animal->save();
            $test_animal2->save();
            $test_animal3->save();
            //Act
            $result = Breed::getAllAnimals('beagle');
            //Assert
            $this->assertEquals([$test_animal, $test_animal2], $result);
        }

        function test_save()
        {
            //Arrange
            $test_Breed = new Breed("beagle");
            //Act
            $test_Breed->save();
            $result = Breed::getAll();
            //Assert
            $this->assertEquals([$test_Breed], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $test_Breed = new Breed("beagle");
            $test_Breed2 = new Breed("husky");
            $test_Breed->save();
            $test_Breed2->save();
            //Act
            Breed::deleteAll();
            $result = Breed::getAll();
            //Assert
            $this->assertEquals([], $result);
        }

        function test_getAll()
        {
            //Arrange
            $test_Breed = new Breed("beagle");
            $test_Breed2 = new Breed("husky");
            $test_Breed->save();
            $test_Breed2->save();
            //Act
            $result = Breed::getAll();
            //Assert
            $this->assertEquals([$test_Breed, $test_Breed2], $result);
        }
    }
 ?>
