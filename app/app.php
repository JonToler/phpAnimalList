<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Animal.php';
    require_once __DIR__.'/../src/Breed.php';
    require_once __DIR__.'/../src/Species.php';
    require_once __DIR__.'/../src/Temperament.php';

    $server = 'mysql:host=localhost;dbname=shelter';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('homepage.html.twig', array('animals' => Animal::getAll(), 'species' => Species::getAll(), 'temperaments' => Temperament::getAll(), 'breeds' => Breed::getAll()));
    });

    $app->post('/post_animal', function() use ($app) {
        $species = $_POST['species'];
        $species_id = Species::findId($species);
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $weight = $_POST['weight'];
        $breed = $_POST['breed'];
        $breed_id = Breed::findId($breed);
        $color = $_POST['color'];
        $months_in_shelter = $_POST['months_in_shelter'];
        $temperament = $_POST['temperament'];
        $temperament_id = Temperament::findId($temperament);
        $animal = new Animal($species_id, $name, $gender, $age, $weight, $breed_id, $color, $months_in_shelter, $temperament_id);
        $animal->save();
        return $app->redirect('/');
    });

    $app->get('/filter_species/{species_description}', function($species_description) use ($app) {
        $filtered_animals = Species::getAllAnimals($species_description);
        return $app['twig']->render('homepage.html.twig', array('animals' => $filtered_animals, 'species' => Species::getAll(), 'temperaments' => Temperament::getAll(), 'breeds' => Breed::getAll()));
    });

    $app->get('/filter_temperament/{temperament_description}', function($temperament_description) use ($app) {
        $filtered_animals = Temperament::getAllAnimals($temperament_description);
        return $app['twig']->render('homepage.html.twig', array('animals' => $filtered_animals, 'species' => Species::getAll(), 'temperaments' => Temperament::getAll(), 'breeds' => Breed::getAll()));
    });

    $app->get('/filter_breed/{breed_description}', function($breed_description) use ($app) {
        $filtered_animals = Breed::getAllAnimals($breed_description);
        return $app['twig']->render('homepage.html.twig', array('animals' => $filtered_animals, 'species' => Species::getAll(), 'temperaments' => Temperament::getAll(), 'breeds' => Breed::getAll()));
    });

    return $app;
 ?>
