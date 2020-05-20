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

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if($_POST['name'] == '' || $_POST['checks'] == ''){
            echo "Please enter something in both fields";
        }
        else{
            $_SESSION['error'] = "";
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['checks'] = $_POST['checks'];

            $f3->reroute('summary');
        }
    }

    $f3->set('checks', $checks);
    $view = new Template();
    echo $view->render('views/survey.html');

});

$f3->route('GET /summary', function() {

    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
});

//Run fat free
$f3->run();