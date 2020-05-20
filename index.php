<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once('vendor/autoload.php');
require_once('controllers/controller.php');

//Instantiate the F3 Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /survey', function($f3) {
    $checks = getChecks();

    $f3->set('checks', $checks);
    $view = new Template();
    echo $view->render('views/survey.html');

});

//Run fat free
$f3->run();