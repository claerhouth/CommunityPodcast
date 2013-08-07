<?php
require 'vendor/autoload.php';


$app = new \Slim\Slim(array(
    'mode' => 'development',
    'debug' => true,
    'templates.path' => './templates'
));

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->post('/login', function () use ($app) {
    $app->render("logincheck.php");
});

$app->get('/', function () use ($app) {
    $app->render('marketingpage.html');
});


$app->run();

?>