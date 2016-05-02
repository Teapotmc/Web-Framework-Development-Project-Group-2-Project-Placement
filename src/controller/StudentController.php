<?php
/**
 * namespace Itb\Controller
 */
namespace Itb\Controller;

/**
 * uses Silex, Symfony and various Models.
 */
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Itb\Model\User;
use Itb\Model\Cv;
use Itb\Model\Message;
use Itb\Model\Pmessage;
use Itb\Model\Job;
use Itb\Model\Ajob;

/**
 * actions for the Student Controller
 * Class StudentController
 * @package Itb\Controller
 */
class StudentController
{
    /**
     * represents Login Controller
     * @var LoginController
     */
    private $loginController;

    /**
     * Constructs Login Controller
     */
    public function __construct()
    {
        $this->loginController = new LoginController();
    }

    /**
     * creates page for viewing Cv
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function cvAction(Request $request, Application $app)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $getUser2 = Cv::getOneByUsername2($username);
            $role = $getUser -> getRole();


            $argsArray = ['Username' => $username, 'role' => $role, 'cv' => $getUser2
            ];

            $templateName = 'student/cv';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * updates the Cv
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processCvUpdateAction(Request $request, Application $app)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();
        $getUser2 = Cv::getOneByUsername2($username);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $experience = filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_STRING);
        $extra = filter_input(INPUT_POST, 'extra', FILTER_SANITIZE_STRING);
        $photo = filter_input(INPUT_POST, 'photo', FILTER_SANITIZE_STRING);

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();

            $newCv = new Cv();
            $newCv->setUsername($username);
            $newCv->setName($name);
            $newCv->setSurname($surname);
            $newCv->setAge($age);
            $newCv->setAddress($address);
            $newCv->setExperience($experience);
            $newCv->setExtra($extra);
            $newCv->setPhoto($photo);

            Cv::updateCv($newCv);

            $success = 'Congratulations '. $username. ' you have successfully updated your CV';
            $return = '/cv';

            $argsArray = ['Username' => $username, 'role' => $role, 'cv' => $getUser2, 'Success' => $success,
                'Return' => $return
            ];

            $templateName = 'success';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }

    }

    /**
     * creates page for creating the general message page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function generalMessageAction(Request $request, Application $app)
    {
        $username = $this->loginController->usernameFromSession();
        $isLoggedIn = $this->loginController->isLoggedInFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser->getRole();
            $message = Message::getAllMessage();


            $argsArray = ['messages' => $message, 'Username' => $username, 'role' => $role];

            $templateName = 'student/generalMessage';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for viewing private messages
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function privateMessageAction(Request $request, Application $app)
    {
        $username = $this->loginController->usernameFromSession();
        $isLoggedIn = $this->loginController->isLoggedInFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser->getRole();
            $message =  Pmessage::searchByColumnPmessage('username',$username);

            $argsArray = ['messages' => $message, 'Username' => $username, 'role' => $role];

            $templateName = 'student/privateMessage';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for viewing a specific private message
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function viewPMessageAction(Request $request, Application $app, $id)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser->getRole();
            $private = Pmessage::getOneById($id);

            $argsArray = ['Username' => $username, 'role' => $role, 'message' => $private ];

            $template = 'student/viewMessage';
            return $app['twig']->render($template . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for viewing a specfic general message
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function viewGMessageAction(Request $request, Application $app, $id)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser->getRole();
            $private = Message::getOneById($id);

            $argsArray = ['Username' => $username, 'role' => $role, 'message' => $private ];

            $template = 'student/viewMessage';
            return $app['twig']->render($template . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for applying for a job
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function applyJobAction(Request $request, Application $app)
    {
        $username = $this->loginController->usernameFromSession();
        $isLoggedIn = $this->loginController->isLoggedInFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser->getRole();
            $job = Job::getAll();

            $argsArray = ['jobs' => $job, 'Username' => $username, 'role' => $role];

            $templateName = 'student/applyJob';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for applying to a specific job
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function applyAction(Request $request, Application $app, $id)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser->getRole();
            $job = Job::getOneById($id);

            $argsArray = ['Username' => $username, 'role' => $role, 'job' => $job ];

            $template = 'student/apply';
            return $app['twig']->render($template . '.html.twig', $argsArray);

        }
    }

    /**
     * Process the application for a Job
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processApplyAction(Request $request, Application $app)
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $emoloyerId = filter_input(INPUT_POST, 'employerId', FILTER_SANITIZE_STRING);
        $deadline = filter_input(INPUT_POST, 'deadline', FILTER_SANITIZE_STRING);
        $student = filter_input(INPUT_POST, 'student', FILTER_SANITIZE_STRING);

        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser->getRole();
            $success = 'Congratulations '. $username. ' you have successfully applied to this job';
            $return = '/applyJob';

            $newAjob = new Ajob();
            $newAjob ->setUsername($username);
            $newAjob ->setName($name);
            $newAjob ->setEmployerId($emoloyerId);
            $newAjob ->setDeadline($deadline);
            $newAjob ->setStudent($student);

            Ajob::insert($newAjob);


            $argsArray = ['Username' => $username, 'role' => $role, 'Success' => $success, 'Return' => $return];

            $template = 'success';
            return $app['twig']->render($template . '.html.twig', $argsArray);

        }
    }

}



