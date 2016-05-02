<?php
/**
 *namespace Itb\Model
 */

namespace Itb\Model;

/**
 *uses MattSmithdev
 */
use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;
use Mattsmithdev\PdoCrud\DatatbaseUtility;

/**
 * Class Ajob
 * @package Itb\Model
 * represents Applied jobs of students
 */
class Ajob extends DatabaseTable
{

    /**
     * id of the Ajob
     * @var int
     */
    private $id;
    /**
     * id of the Ajob
     * @var string
     */
    private $username;
    /**
     * name of the Ajob
     * @var string
     */
    private $name;
    /**
     * name of the Ajob
     * @var string
     */
    private $employerId;
    /**
     * employerId of the Ajob
     * @var string
     */
    private $deadline;
    /**
     * deadline of the Ajob
     * @var string
     */
    private $student;
    /**
     * student name of the Ajob
     * @var string
     */

    /**
     * get the id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * set id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * get the name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * set name
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * get the username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * set username
     * @param $uusername
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    /**
     * get the employerId
     * @return string
     */
    public function getEmployerId()
    {
        return $this->employerId;
    }
    /**
     * set employerId
     * @param $employerId
     */
    public function setEmployerId($employerId)
    {
        $this->employerId = $employerId;
    }
    /**
     * get the deadline
     * @return string
     */
    public function getDeadline()
    {
        return $this->deadline;
    }
    /**
     * set deadline
     * @param $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }
    /**
     * get the student
     * @return string
     */
    public function getStudent()
    {
        return $this->student;
    }
    /**
     * set student
     * @param $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }

    /**
     * gets one by employerId
     * @param $employerId
     * @return mixed|null
     */
    public static function getOneByEmployerId($employerId)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM ajobs WHERE employerId=:employerId';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':employerId', $employerId, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        if ($object = $statement->fetch()) {
            return $object;
        } else {
            return null;
        }
    }

    /**
     * gets one by username
     * @param $username
     * @return mixed|null
     */
    public static function getOneByUsername($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM users WHERE username=:username';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        if ($object = $statement->fetch()) {
            return $object;
        } else {
            return null;
        }
    }

}