<?php
/**
 * namespace Itb\Controller
 */
namespace Itb\Controller;

/**
 * uses multiple Models, sILEX AND sYMFONY
 */
use Itb\Model\Employer;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Itb\Model\User;
use Itb\Model\Message;
use Itb\Model\Pmessage;
use Itb\Model\Job;
use Itb\Model\Cv;
use Itb\Model\Student;

/**
 * Class for admin actions
 * Class AdminController
 * @package Itb\Controller
 */
class AdminController
{
    /**
     * represents login controller
     * @var LoginController
     */
    private $loginController;

    /**
     * constructs login controller
     */
    public function __construct()
    {
        $this->loginController = new LoginController();
    }

    /**
     * creates general page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function pGeneralAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */

        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();

            $argsArray = ['Username' => $username, 'role' => $role
            ];

            $templateName = 'admin/pGeneral';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * process the creation of a new general message
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processGeneralAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */

        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();
            $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
            $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

            $newJob = new message();
            $newJob -> setSubject($subject);
            $newJob -> setContent($content);
            $newJob -> setComment($comment);
            Message::insert($newJob);

            $success = 'Message Sent';
            $return = '/pGeneral';

            $argsArray = ['Username' => $username, 'role' => $role, 'Success' => $success, 'Return' => $return
            ];

            $templateName = 'success';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }

    }

    /**
     * creates private message page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function pPrivateMessageAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */

        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $getAllUser = User::getAll();
            $role = $getUser -> getRole();
            $message =  Pmessage::searchByColumnPmessage('username',$username);


            $argsArray = ['Username' => $username, 'role' => $role, 'users' => $getAllUser, 'messages' => $message

            ];

            $templateName = 'admin/pPrivateMessage';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * process for creating new private message
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processPrivateAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */

        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();
            $sendUser= filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
            $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

            $newPrivate = new pmessage();
            $newPrivate -> setUsername($sendUser);
            $newPrivate -> setSubject($subject);
            $newPrivate -> setContent($content);
            $newPrivate -> setComment($comment);
            Pmessage::insert($newPrivate);

            $success = 'Message Sent';
            $return = '/pPrivateMessage';


            $argsArray = ['Username' => $username, 'role' => $role, 'Success' => $success, 'Return' => $return
            ];

            $templateName = 'success';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }

    }

    /**
     * creates a page for viewing a selected private message
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function viewPrivateAction(Request $request, Application $app, $id)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */

        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser->getRole();
            $private = Pmessage::getOneById($id);

            $argsArray = ['Username' => $username, 'role' => $role, 'message' => $private ];

            $template = 'admin/viewPrivate';
            return $app['twig']->render($template . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for new job
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function newJobAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */

        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();

            $argsArray = ['Username' => $username, 'role' => $role
            ];

            $templateName = 'admin/newJob';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * process for creating new job
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processNewJobAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();
            $name= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $details = filter_input(INPUT_POST, 'details', FILTER_SANITIZE_STRING);
            $employerId = filter_input(INPUT_POST, 'employer', FILTER_SANITIZE_STRING);
            $deadline = filter_input(INPUT_POST, 'deadline', FILTER_SANITIZE_STRING);


            $newJob = new job();
            $newJob -> setName($name);
            $newJob -> setDetails($details);
            $newJob -> setEmployerId($employerId);
            $newJob -> setDeadline($deadline);
            Job::insert($newJob);

            $success = 'Job Created';
            $return = '/newJob';


            $argsArray = ['Username' => $username, 'role' => $role, 'Success' => $success, 'Return' => $return
            ];

            $templateName = 'success';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }

    }

    /**
     * process for registering new employee
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processRegisterEmpAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username2 = $this->loginController->usernameFromSession();
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $employerId = filter_input(INPUT_POST, 'employerId', FILTER_SANITIZE_STRING);

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username2);
            $role = $getUser->getRole();

            $newUser = new User();
            $newUser->setUsername($username);
            $newUser->setPassword($password);
            $newUser->setRole(User::ROLE_Employer);

            User::insert($newUser);

            $newEmployer = new Employer();
            $newEmployer->setUsername($username);
            $newEmployer->setEmployerId($employerId);

            Employer::insert($newEmployer);


            $success = 'Employer Registered';
            $return = '/newJob';


            $argsArray = ['Username' => $username2, 'role' => $role, 'Success' => $success, 'Return' => $return ];

            $template = 'success';
            return $app['twig']->render($template . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for viewing cvs
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function aCvAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();
            $cv= Cv::getAll();


            $argsArray = ['Username' => $username, 'role' => $role, 'cvs' => $cv
            ];

            $templateName = 'admin/aCv';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for viewing specfic cv
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function viewCvAction(Request $request, Application $app, $id)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser->getRole();
            $cv = Cv::getOneById($id);

            $argsArray = ['Username' => $username, 'role' => $role, 'cv' => $cv];

            $template = 'admin/viewCv';
            return $app['twig']->render($template . '.html.twig', $argsArray);

        }
    }

    /**
     * creates page for viewing students
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function studentAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();
            $student = Student::getAll();


            $argsArray = ['Username' => $username, 'role' => $role, 'students' => $student
            ];

            $templateName = 'admin/student';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * updates studnet
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function updateStudentAction(Request $request, Application $app, $id)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser->getRole();
            $student = Student::getOneById($id);

            $argsArray = ['Username' => $username, 'role' => $role, 'student' => $student ];

            $template = 'admin/updateStudent';
            return $app['twig']->render($template . '.html.twig', $argsArray);

        }
    }

    /**
     * process student update
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processUpdateAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username2 = $this->loginController->usernameFromSession();
        $username= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $employed= filter_input(INPUT_POST, 'employed', FILTER_SANITIZE_STRING);

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username2);
            $role = $getUser->getRole();

            $newStudent = new Student();
            $newStudent->setUsername($username);
            $newStudent->setEmployed($employed);

            Student::updateStudent($newStudent);

            $success = 'Student Updated';
            $return = '/student';


            $argsArray = ['Username' => $username, 'role' => $role, 'Success' => $success, 'Return' => $return ];

            $template = 'success';
            return $app['twig']->render($template . '.html.twig', $argsArray);

        }
    }

    /**
     * page for crud actions
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function crudAction(Request $request, Application $app)
    {
        /**
         * Gets LoggedInSession and Username from Session
         */
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        $username = $this->loginController->usernameFromSession();
        $getAllUser = User::getAll();

        /**
         * Checks if logged in
         */
        if($isLoggedIn)
        {
            $getUser = User::getOneByUsername($username);
            $role = $getUser -> getRole();


            $argsArray = ['Username' => $username, 'role' => $role, 'users' =>$getAllUser
            ];

            $templateName = 'admin/crud';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
    }

    /**
     * process for create action
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processCreateAction(Request $request, Application $app)
    {
        /**
         * Gets Username from Session
         */
        $username2 = $this->loginController->usernameFromSession();
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $getUser = User::getOneByUsername($username2);
        $role = $getUser->getRole();

        /**
         * Checks if username is taken
         */
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


            $success = 'Student Created';
            $return = '/crud';

            $argsArray = ['Username' => $username2, 'role' => $role,'Success' => $success, 'Return' => $return
            ];

            $templateName = 'success';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }

    /**
     * process for update crud action
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processUpdateCrudAction(Request $request, Application $app)
    {
        /**
         * Gets Username from Session
         */
        $username2 = $this->loginController->usernameFromSession();
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $getUser = User::getOneByUsername($username2);
        $role = $getUser->getRole();


        /**
         * Checks if username is taken
         */
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
            User::updateUser($newUser);

            $newCv = new Cv();
            $newCv->setUsername($username);
            $newCv->setName('john');
            $newCv->setSurname('doe');
            $newCv->setAge('21');
            $newCv->setAddress('itb');
            $newCv->setExperience('mcdonalds');
            $newCv->setExtra('');
            $newCv->setPhoto('blank.jpg');

            Cv::updateCv($newCv);

            $newStudent = new Student();
            $newStudent->setUsername($username);
            $newStudent->setEmployed(Student::EMPLOYED_UNEMPLOYED);

            Student::updateStudent($newStudent);


            $success = 'Student Updated';
            $return = '/crud';

            $argsArray = ['Username' => $username2, 'role' => $role,'Success' => $success, 'Return' => $return
            ];
            $templateName = 'success';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }

    /**
     * process for delete action
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processDeleteAction(Request $request, Application $app)
    {
        /**
         * Gets Username from Session
         */
        $username2 = $this->loginController->usernameFromSession();
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $getUser = User::getOneByUsername($username2);
        $role = $getUser->getRole();


        /**
         * Checks if username is taken
         */
        if ($username == $getUser) {
            $message = 'Username Taken';

            $argsArray = ['message' => $message
            ];

            $templateName = 'message';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }

        else {

            User::deleteUser($username);
            Student::deleteStudent($username);
            Cv::deleteCv($username);


            $success = 'Student Deleted';
            $return = '/crud';

            $argsArray = ['Username' => $username2, 'role' => $role,'Success' => $success, 'Return' => $return
            ];

            $templateName = 'success';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }

}