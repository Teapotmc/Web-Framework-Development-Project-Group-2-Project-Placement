<?php
/**
 * Name space Itb\Model
 */

namespace Itb\Model;

/**
 * uses Mattsmithdev
 */
use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;
use Mattsmithdev\PdoCrud\DatatbaseUtility;

/**
 * represents Job details
 * Class Job
 * @package Itb\Model
 */
class Job extends DatabaseTable
{
    /**
     * represents id of Job
     * @var int
     */
    private $id;
    /**
     * represents name of Job
     * @var string
     */
    private $name;
    /**
     * represents details of job
     * @var string
     */
    private $details;

    /**
     * represents details of employerId
     * @var string
     */
    private $employerId;
    /**
     * represents deadline of Job
     * @var string
     */
    private $deadline;

    /**
     * gets id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * sets id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * gets name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * sets name
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * gets detail
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * set details
     * @param $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * get employerId
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
     * get deadline
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
     * gets one by id
     * @param $id
     * @return mixed|null
     */
    public static function getOneByIdJob($id)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $statement = $connection->prepare('SELECT * from jobs WHERE id=:id');
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\' .  static::class);
        $statement->execute();

        if ($job = $statement->fetch()) {
            return $job;
        } else {
            return null;
        }
    }

    /**
     * gets one by EmployerId
     * @param $employerId
     * @return mixed|null
     */
    public static function getOneByEmployerId($employerId)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM jobs WHERE employerId=:employerId';
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

}