<?php
session_start();

/**
 * uses various Controllers
 */
use Itb\Controller\MainController;
use Itb\Controller\AdminController;
use Itb\Controller\LoginController;


/**
 * requires app setup and the Utility
 */
require_once __DIR__ . '/../app/setup.php';
require_once __DIR__ . '/../src/utility/Utility.php';

/**
 * Main Controller routes
 */
$app->get('/', \Itb\utility\Utility::controller('Itb\Controller', 'main/index'));
$app->get('/about', \Itb\utility\Utility::controller('Itb\Controller', 'main/about'));
$app->get('/login', \Itb\utility\Utility::controller('Itb\Controller', 'main/login'));
$app->get('/register', \Itb\utility\Utility::controller('Itb\Controller', 'main/register'));
$app->get('/message', \Itb\utility\Utility::controller('Itb\Controller', 'main/message'));

/**
 * Login Controller routes
 */
$app->post('/processLogin', \Itb\utility\Utility::controller('Itb\Controller', 'login/processLogin'));
$app->post('/processRegister', \Itb\utility\Utility::controller('Itb\Controller', 'login/processRegister'));
$app->get('/logout', \Itb\utility\Utility::controller('Itb\Controller', 'login/logout'));

/**
 * Admin Controller routes
 */
$app->get('/pGeneral', \Itb\utility\Utility::controller('Itb\Controller', 'admin/pGeneral'));
$app->post('/processGeneral', \Itb\utility\Utility::controller('Itb\Controller', 'admin/processGeneral'));
$app->get('/pPrivateMessage', \Itb\utility\Utility::controller('Itb\Controller', 'admin/pPrivateMessage'));
$app->post('/processPrivate', \Itb\utility\Utility::controller('Itb\Controller', 'admin/processPrivate'));
$app->get('/viewPrivate&{id}', \Itb\utility\Utility::controller('Itb\Controller', 'admin/viewPrivate'));
$app->get('/newJob', \Itb\utility\Utility::controller('Itb\Controller', 'admin/newJob'));
$app->post('/processNewJob', \Itb\utility\Utility::controller('Itb\Controller', 'admin/processNewJob'));
$app->post('/processRegisterEmp', \Itb\utility\Utility::controller('Itb\Controller', 'admin/processRegisterEmp'));
$app->get('/aCv', \Itb\utility\Utility::controller('Itb\Controller', 'admin/aCv'));
$app->get('/viewCv&{id}', \Itb\utility\Utility::controller('Itb\Controller', 'admin/viewCv'));
$app->get('/student', \Itb\utility\Utility::controller('Itb\Controller', 'admin/student'));
$app->get('/updateStudent&{id}', \Itb\utility\Utility::controller('Itb\Controller', 'admin/updateStudent'));
$app->post('/processUpdate', \Itb\utility\Utility::controller('Itb\Controller', 'admin/processUpdate'));
$app->get('/crud', \Itb\utility\Utility::controller('Itb\Controller', 'admin/crud'));
$app->post('/processCreate', \Itb\utility\Utility::controller('Itb\Controller', 'admin/processCreate'));
$app->post('/processUpdateCrud', \Itb\utility\Utility::controller('Itb\Controller', 'admin/processUpdateCrud'));
$app->post('/processDelete', \Itb\utility\Utility::controller('Itb\Controller', 'admin/processDelete'));

/**
 * Student Controller routes
 */
$app->get('/cv', \Itb\utility\Utility::controller('Itb\Controller', 'student/cv'));
$app->post('/processCvUpdate', \Itb\utility\Utility::controller('Itb\Controller', 'student/processCvUpdate'));
$app->get('/generalMessage', \Itb\utility\Utility::controller('Itb\Controller', 'student/generalMessage'));
$app->get('/privateMessage', \Itb\utility\Utility::controller('Itb\Controller', 'student/privateMessage'));
$app->get('/viewPMessage&{id}', \Itb\utility\Utility::controller('Itb\Controller', 'student/viewPMessage'));
$app->get('/viewGMessage&{id}', \Itb\utility\Utility::controller('Itb\Controller', 'student/viewGMessage'));
$app->get('/applyJob', \Itb\utility\Utility::controller('Itb\Controller', 'student/applyJob'));
$app->get('/apply&{id}', \Itb\utility\Utility::controller('Itb\Controller', 'student/apply'));
$app->post('/processApply', \Itb\utility\Utility::controller('Itb\Controller', 'student/processApply'));

/**
 * Employer Controller Routes
 */
$app->get('/downloadCv', \Itb\utility\Utility::controller('Itb\Controller', 'employer/downloadCv'));
$app->get('/download', \Itb\utility\Utility::controller('Itb\Controller', 'employer/download'));
$app->get('/ePrivateMessage', \Itb\utility\Utility::controller('Itb\Controller', 'employer/ePrivateMessage'));
$app->post('/eProcessPrivate', \Itb\utility\Utility::controller('Itb\Controller', 'employer/eProcessPrivate'));


/**
 * Error 404 routes
 */
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            return \Itb\Controller\MainController::error404($app, $message);

        default:
            $message = 'We are sorry, but something went terribly wrong.';
            return \Itb\Controller\MainController::error404($app, $message);
    }
});

// run Silex front controller
// ------------
$app->run();


