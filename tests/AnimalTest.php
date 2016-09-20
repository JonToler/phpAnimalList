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
            $test_animal2 = new Animal(3, 'Bill', 'Male', 8, 23, 4, 'Black', 2, 4);
            $test_animal->save();
            $test_animal2->save();
            //Act
            Animal::deleteAll();
            //Assert
            $this->assertEquals([], Animal::getAll());
        }

        function test_deleteItem()
        {
            //Arrange
            $test_animal = new Animal(2, 'Hank', 'Male', 7, 32, 3, 'Black', 3, 2);
            $test_animal2 = new Animal(3, 'Bill', 'Male', 8, 23, 4, 'Black', 2, 4);
            $test_animal->save();
            $test_animal2->save();
            //Act
            $test_animal2->deleteItem();
            //Assert
            $this->assertEquals([$test_animal], Animal::getAll());
        }

        function test_sort()
        {
            $test_animal = new Animal(2, 'Hank', 'Male', 7, 32, 3, 'Black', 3, 2);
            $test_animal2 = new Animal(3, 'Bill', 'Male', 8, 23, 4, 'Black', 2, 4);
            $test_animal3 = new Animal(4, 'Chloe', 'Female', 7, 14, 3, 'Red', 6, 3);
            $test_animal->save();
            $test_animal2->save();
            $test_animal3->save();
            //Act
            $result = Animal::sort();
            //Assert
            $this->assertEquals([$test_animal2, $test_animal, $test_animal3], $result);
        }

    }
 ?>
