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
 * details for users
 * Class User
 * @package Itb\Model
 */
class User extends DatabaseTable
{
    /**
     * constant for user
     */
    const ROLE_USER = 1;
    /**
     * constants for Admin
     */
    const ROLE_ADMIN = 2;
    /**
     * constants for employer
     */
    const ROLE_Employer = 3;

    /**
     * represents id of user
     * @var int
     */
    private $id;
    /**
     * represents username of user
     * @var string
     */
    private $username;
    /**
     * represents password of users
     * @var string
     */
    private $password;
    /**
     * represents role of user
     * @var string
     */
    private $role;


    /**
     * get id
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
     * set username
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * get password
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * get role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * set role
     * @param $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * set password and hashes it
     * @param $password
     */
    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->password = $hashedPassword;
    }

    /**
     * finds matching username and password
     * @param $username
     * @param $password
     * @return bool
     */
    public static function canFindMatchingUsernameAndPassword($username, $password)
    {
        $user = User::getOneByUsername($username);

        // if no record has this username, return FALSE
        if(null == $user){
            return false;
        }

        // hashed correct password
        $hashedStoredPassword = $user->getPassword();

        // return whether or not hash of input password matches stored hash
        return password_verify($password, $hashedStoredPassword);
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

    /**
     * delete user
     * @param $username
     * @return bool
     */
    public static function deleteUser($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $statement = $connection->prepare('DELETE from ' . static::getTableName()  . ' WHERE username=:username');
        $statement->bindParam(':username', $username, \PDO::PARAM_INT);
        $queryWasSuccessful = $statement->execute();
        return $queryWasSuccessful;
    }

    /**
     * update user
     * @param DatabaseTable $object
     * @return bool
     */
    public static function updateUser(DatabaseTable $object)
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




}