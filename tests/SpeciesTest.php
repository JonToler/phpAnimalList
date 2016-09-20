<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    **/

    require_once "src/Species.php";
    require_once "src/Animal.php";

    $server = 'mysql:host=localhost;dbname=shelter_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class SpeciesTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Species::deleteAll();
            Animal::deleteAll();
        }

        function test_getAllAnimals()
        {
            //Arrange
            $test_Species = new Species("cat");
            $test_Species2 = new Species("dog");
            $test_Species->save();
            $test_Species2->save();
            $test_animal = new Animal($test_Species->getId(), 'Hank', 'Male', 7, 32, 3, 'Black', 3, 2);
            $test_animal2 = new Animal($test_Species->getId(), 'Bill', 'Male', 8, 23, 2, 'Black', 2, 4);
            $test_animal3 = new Animal($test_Species2->getId(), 'Chloe', 'Female', 7, 14, 1, 'Red', 6, 3);
            $test_animal->save();
            $test_animal2->save();
            $test_animal3->save();
            //Act
            $result = Species::getAllAnimals('cat');
            //Assert
            $this->assertEquals([$test_animal, $test_animal2], $result);
        }

        function test_save()
        {
            //Arrange
            $test_Species = new Species("cat");
            //Act
            $test_Species->save();
            $result = Species::getAll();
            //Assert
            $this->assertEquals([$test_Species], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $test_Species = new Species("cat");
            $test_Species2 = new Species("dog");
            $test_Species->save();
            $test_Species2->save();
            //Act
            Species::deleteAll();
            $result = Species::getAll();
            //Assert
            $this->assertEquals([], $result);
        }

        function test_getAll()
        {
            //Arrange
            $test_Species = new Species("cat");
            $test_Species2 = new Species("dog");
            $test_Species->save();
            $test_Species2->save();
            //Act
            $result = Species::getAll();
            //Assert
            $this->assertEquals([$test_Species, $test_Species2], $result);
        }
    }
 ?>
