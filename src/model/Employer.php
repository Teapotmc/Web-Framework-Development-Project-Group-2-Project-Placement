<?php
/**
 * name space Itb\Model
 */
namespace Itb\Model;

/**
 * uses Mattsmithdev
 */
use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;
use Mattsmithdev\PdoCrud\DatatbaseUtility;

/**
 * represents employer details
 * Class Employer
 * @package Itb\Model
 */
class Employer extends DatabaseTable
{
    /**
     * id of employer
     * @var int
     */
    private $id;
    /**
     * username of employer
     * @var string
     */
    private $username;
    /**
     * employerId of employer
     * @var string
     */
    private $employerId;

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
     * gets username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * sets username
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * gets employerId
     * @return string
     */
    public function getEmployerId()
    {
        return $this->employerId;
    }

    /**
     * sets employerId
     * @param $employerId
     */
    public function setEmployerId($employerId)
    {
        $this->employerId = $employerId;
    }
}
