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

$con = pg_connect("host=$host dbname=$dbname user=$user password=$password port=$port")
    or die ("Could not connect to server\n"); 

$query = "SELECT * FROM messages"; 

$rs = pg_query($con, $query) or die("Cannot execute query: $query\n");

echo("<table border=2><tr><td>id</td><td>name</td><td>content</td></tr>");
while ($row = pg_fetch_assoc($rs)) {
    echo("<tr>");
    echo("<td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['content']."</td>");
    echo("</tr>\n");
}
echo("</table>");

pg_close($con);