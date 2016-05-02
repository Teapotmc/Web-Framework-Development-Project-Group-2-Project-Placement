<?php
/**
 * namespace Itb\Controller
 */
namespace Itb\Controller;

/**
 * uses Silex, Symfony and various Models
 */
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Itb\Model\User;
use Itb\Model\Pmessage;
use Itb\Model\Cv;

/**
 * class for Employer action
 * Class EmployerController
 * @package Itb\Controller
 */
class EmployerController
{
    /**
     * represents login controller
     * @var LoginController
     */
    private $loginController;

    /**
     * constructs loginController
     */
    public function __construct()
    {
        $this->loginController = new LoginController();
    }

    /**
     * creates page for the downloading a list of cvs
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function downloadCvAction(Request $request, Application $app)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();

            $argsArray = ['Username' => $username, 'role' => $role
            ];

            $templateName = 'employer/downloadCv';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for viewing downloaded cvs
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function downloadAction(Request $request, Application $app)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();
            $cv = Cv::getAll();


            $argsArray = ['Username' => $username, 'role' => $role, 'cvs' => $cv
            ];

            $templateName = 'employer/download';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * creates private message page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function ePrivateMessageAction(Request $request, Application $app)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $getAllUser = User::getAll();
            $role = $getUser -> getRole();
            $message =  Pmessage::searchByColumnPmessage('username',$username);


            $argsArray = ['Username' => $username, 'role' => $role, 'users' => $getAllUser, 'messages' => $message

            ];

            $templateName = 'employer/ePMessage';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * process the private messages in order to send messages
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function eProcessPrivateAction(Request $request, Application $app)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username2 = $this->loginController->usernameFromSession();
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username2);
            $role = $getUser -> getRole();


            $newPrivate = new Pmessage();
            $newPrivate -> setUsername($username);
            $newPrivate -> setSubject($subject);
            $newPrivate -> setContent($content);
            $newPrivate -> setComment($comment);
            Pmessage::insert($newPrivate);

            $success = 'Message Sent';
            $return = '/ePrivateMessage';


            $argsArray = ['Username' => $username2, 'role' => $role, 'Success' => $success, 'Return' => $return
            ];

            $templateName = 'success';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }

    }

}