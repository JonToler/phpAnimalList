<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    **/

    require_once "src/Temperament.php";
    require_once "src/Animal.php";

    $server = 'mysql:host=localhost;dbname=shelter_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TemperamentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Temperament::deleteAll();
            Animal::deleteAll();
        }

        function test_getAllAnimals()
        {
            //Arrange
            $test_temperament = new Temperament("cat");
            $test_temperament2 = new Temperament("dog");
            $test_temperament->save();
            $test_temperament2->save();
            $test_animal = new Animal(1, 'Hank', 'Male', 7, 32, 3, 'Black', 3, $test_temperament->getId());
            $test_animal2 = new Animal(1, 'Bill', 'Male', 8, 23, 2, 'Black', 2, $test_temperament->getId());
            $test_animal3 = new Animal(1, 'Chloe', 'Female', 7, 14, 1, 'Red', 6, $test_temperament2->getId());
            $test_animal->save();
            $test_animal2->save();
            $test_animal3->save();
            //Act
            $result = Temperament::getAllAnimals('cat');
            //Assert
            $this->assertEquals([$test_animal, $test_animal2], $result);
        }

        function test_save()
        {
            //Arrange
            $test_temperament = new Temperament("cat");
            //Act
            $test_temperament->save();
            $result = Temperament::getAll();
            //Assert
            $this->assertEquals([$test_temperament], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $test_temperament = new Temperament("cat");
            $test_temperament2 = new Temperament("dog");
            $test_temperament->save();
            $test_temperament2->save();
            //Act
            Temperament::deleteAll();
            $result = Temperament::getAll();
            //Assert
            $this->assertEquals([], $result);
        }

        function test_getAll()
        {
            //Arrange
            $test_temperament = new Temperament("cat");
            $test_temperament2 = new Temperament("dog");
            $test_temperament->save();
            $test_temperament2->save();
            //Act
            $result = Temperament::getAll();
            //Assert
            $this->assertEquals([$test_temperament, $test_temperament2], $result);
        }
    }
 ?>
