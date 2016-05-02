<?php
//----- autoload any classes we are using ------
require_once __DIR__ . '/../vendor/autoload.php';

use Itb\MainController;

//----- Twig setup --------------
$templatesPath = __DIR__ . '/../templates';
$loader = new Twig_Loader_Filesystem($templatesPath);
$twig = new Twig_Environment($loader);


// setup Silex
// ------------
$app = new Silex\Application();

// register Twig with Silex
// ------------
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $templatesPath
));

//Database Connection
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'itb');

