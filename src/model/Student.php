<?php
/**
 * namespace Itb\Model
 */
namespace Itb\Model;

/**
 * uses Mattsmithdev
 */
use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;
use Mattsmithdev\PdoCrud\DatatbaseUtility;

/**
 * represents details of Student
 * Class Student
 * @package Itb\Model
 */
class Student extends DatabaseTable
{
    /**
     * constants for employed
     */
    const EMPLOYED_EMPLOYED = 'Employed';
    /**
     * constant for unemployed
     */
    const EMPLOYED_UNEMPLOYED = 'Unemployed';

    /**
     * id for student
     * @var int
     */
    private $id;
    /**
     * username for student
     * @var string
     */
    private $username;
    /**
     * employment status for student
     * @var string
     */
    private $employed;

    /**
     * gets id
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
     * get username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * set username
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * gets employed
     * @return string
     */
    public function getEmployed()
    {
        return $this->employed;
    }

    /**
     * set employed
     * @param $employed
     */
    public function setEmployed($employed)
    {
        $this->employed = $employed;
    }

    /**
     * updates student
     * @param DatabaseTable $object
     * @return bool
     */
    public static function updateStudent(DatabaseTable $object)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $objectAsArrayForSqlInsert = DatatbaseUtility::objectToArrayLessId($object);
        $fields = array_keys($objectAsArrayForSqlInsert);
        $updateFieldList = DatatbaseUtility::fieldListToUpdateString($fields);

        $sql = 'UPDATE '. static::getTableName() . ' SET ' . $updateFieldList  . ' WHERE username=:username';
        $statement = $connection->prepare($sql);

        // add 'id' to parameters array
        $objectAsArrayForSqlInsert['id'] = $object->getId();

        $queryWasSuccessful = $statement->execute($objectAsArrayForSqlInsert);

        return $queryWasSuccessful;
    }

    /**
     * deletes student
     * @param $username
     * @return bool
     */
    public static function deleteStudent($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $statement = $connection->prepare('DELETE from ' . static::getTableName()  . ' WHERE username=:username');
        $statement->bindParam(':username', $username, \PDO::PARAM_INT);
        $queryWasSuccessful = $statement->execute();
        return $queryWasSuccessful;
    }

}
