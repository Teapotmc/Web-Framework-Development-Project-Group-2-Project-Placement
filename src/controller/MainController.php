<?php
/**
 * namespace Itb\Controller
 */
namespace Itb\Controller;

/**
 * Uses Silex, Symfony and the model User
 */
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Itb\Model\User;

/**
 * Class for Main actions
 * Class MainController
 * @package Itb\Controller
 */
class MainController
{

    /**
     * represents LoginController
     * @var LoginController
     */
    private $loginController;

    /**
     * constructs Logincontroller
     */
    public function __construct()
    {
        $this->loginController = new LoginController();
    }

    /**
     * creates page for the about oage
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function aboutAction(Request $request, Application $app)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();

            $argsArray = ['Username' => $username, 'role' => $role
            ];

            $templateName = 'about';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }

        else
        {

            $argsArray = ['Username' => $username
            ];

            $templateName = 'about';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * render the Index page template
     */

    /**
     * creates page for the index home page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Request $request, Application $app)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();

            $argsArray = ['Username' => $username, 'role' => $role
            ];

            $templateName = 'index';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }

        else
        {

            $argsArray = ['Username' => $username
            ];

            $templateName = 'index';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for the login form
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function loginAction(Request $request, Application $app)
    {
        $argsArray = [];

        $templateName = 'loginForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * creates page for the register action
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function registerAction(Request $request, Application $app)
    {

        $argsArray = [];

        $templateName = 'registerForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * displays an error 404
     * @param Application $app
     * @param $message
     * @return mixed
     */
    public static function error404(Application $app, $message)
    {
        $argsArray = [
            'name' => 'Fabien',
        ];
        $templateName = '404';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }


}