<?php

// require('../vendor/autoload.php');

// $app = new Silex\Application();
// $app['debug'] = true;

// // Register the monolog logging service
// $app->register(new Silex\Provider\MonologServiceProvider(), array(
//   'monolog.logfile' => 'php://stderr',
// ));

// // Register view rendering
// $app->register(new Silex\Provider\TwigServiceProvider(), array(
//     'twig.path' => __DIR__.'/views',
// ));

// // Our web handlers

// $app->get('/', function() use($app) {
//   $app['monolog']->addDebug('logging output.');
//   return $app['twig']->render('index.twig');
// });

// $app->run();

$host = "ec2-35-168-65-132.compute-1.amazonaws.com";
$user = "noslwbomptkwqe";
$password = "e3f9b5d3c98a6c537dc95742c2ba4cc92da7d47320d793973962089918693fed";
$dbname = "d3hgn6jvibk5nu";
$port = "5432";

try{
  //Set DSN data source name
    $dsn = "pgsql:host=" . $host . ";port=" . $port .";dbname=" . $dbname . ";user=" . $user . ";password=" . $password . ";";


  //create a pdo instance
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
echo 'Connection failed: ' . $e->getMessage();
}

$sql = 'SELECT * FROM messages';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rowCount = $stmt->rowCount();
$details = $stmt->fetch();

print_r ($details);

echo "<table>"; // start a table tag in the HTML

while($details){   //Creates a loop to loop through results
echo "<tr><td>" . $details['name'] . "</td><td>" . $details['content'] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML