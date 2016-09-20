<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    **/

    require_once "src/Animal.php";

    $server = 'mysql:host=localhost;dbname=shelter_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class AnimalTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Animal::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $test_animal = new Animal(2, 'Hank', 'Male', 7, 32, 3, 'Black', 3, 2);
            //Act
            $test_animal->save();
            //Assert
            $this->assertEquals([$test_animal], Animal::getAll());
        }

        function test_getAll()
        {
            //Arrange
            $test_animal = new Animal(2, 'Hank', 'Male', 7, 32, 3, 'Black', 3, 2);
            $test_animal2 = new Animal(3, 'Bill', 'Male', 8, 23, 4, 'Black', 2, 4);
            //Act
            $test_animal->save();
            $test_animal2->save();
            //Assert
            $this->assertEquals([$test_animal, $test_animal2], Animal::getAll());
        }

        function test_deleteAll()
        {
            //Arrange
            $test_animal = new Animal(2, 'Hank', 'Male', 7, 32, 3, 'Black', 3, 2);
            $test_animal2 = new Animal(2, 'Bill', 'Male', 7, 32, 3, 'Black', 3, 2);
            $test_animal->save();
            $test_animal2->save();
            //Act
            Animal::deleteAll();
            //Assert
            $this->assertEquals([], Animal::getAll());
        }
    }
 ?>
