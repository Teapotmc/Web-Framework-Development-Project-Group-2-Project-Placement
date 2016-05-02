<?php
/**
 * namespace Itb\Controller
 */
namespace Itb\Controller;

/**
 * uses Silex, Symfony and various models
 */
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Itb\Model\User;
use Itb\Model\Cv;
use Itb\Model\Student;

/**
 * Class for Login actions
 * Class LoginController
 * @package Itb\Controller
 */
class LoginController
{

    /**
     * Process for logging out
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function logoutAction(Request $request, Application $app)
    {
        unset($_SESSION['user']);

        $argsArray = [];

        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Processes the action for logging in
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processLoginAction(Request $request, Application $app)
    {
        $isLoggedIn = false;
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

        // search for user with username in repository
        $isLoggedIn = User::canFindMatchingUsernameAndPassword($username, $password);
        $getUser = User::getOneByUsername($username);
        $role = $getUser->getRole();

        if ($isLoggedIn) {
            // STORE login status SESSION
            $_SESSION['user'] = $username;

            $success = 'Congratulations ' . $username . ' you have successfully logged in';
            $return = '/';

            $argsArray = ['Username' => $username, 'role' => $role, 'Success' => $success, 'Return' => $return
            ];
            $templateName = 'success';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }

        else
        {
            $message = 'bad username or password, please try again';

            $argsArray = [
                'message' => 'bad username or password, please try again'
            ];

            $templateName = 'message';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * Process for registering a new user
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processRegisterAction(Request $request, Application $app)
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $getUser = User::searchByColumn('username', $username);


        if ($username == $getUser) {
            $message = 'Username Taken';
            $argsArray = ['message' => $message
            ];
            $templateName = 'message';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }

        else {

            $newUser = new User();
            $newUser->setUsername($username);
            $newUser->setPassword($password);
            $newUser->setRole(User::ROLE_USER);
            User::insert($newUser);

            $newCv = new Cv();
            $newCv->setUsername($username);
            $newCv->setName('john');
            $newCv->setSurname('doe');
            $newCv->setAge('21');
            $newCv->setAddress('itb');
            $newCv->setExperience('mcdonalds');
            $newCv->setExtra('');
            $newCv->setPhoto('blank.jpg');

            Cv::insert($newCv);

            $newStudent = new Student();
            $newStudent->setUsername($username);
            $newStudent->setEmployed(Student::EMPLOYED_UNEMPLOYED);

            Student::insert($newStudent);


            $success = 'Congratulations ' . $username . ' you have successfully registered';
            $return = '/';

            $argsArray = ['Success' => $success, 'Return' => $return
            ];
            $templateName = 'success';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }

    /**
     * returns logged in from session
     * @return bool
     */
    public function isLoggedInFromSession()
    {
        $isLoggedIn = false;

        if (isset($_SESSION['user']))
        {
            $isLoggedIn = true;
        }

        return $isLoggedIn;
    }

    /**
     * returns username from session
     * @return string
     */
    public function usernameFromSession()
    {
        $username = '';

        if (isset($_SESSION['user']))
        {
            $username = $_SESSION['user'];
        }

        return $username;
    }

}