<?php
/**
 * namespace Itb/Model
 */
namespace Itb\Model;

/**
 * uses Mattsmithdev
 */
use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;
use Mattsmithdev\PdoCrud\DatatbaseUtility;

/**
 * Class Cv
 * represents details of Cv
 * @package Itb\Model
 */
class Cv extends DatabaseTable
{
    /**
     * id of cv
     * @var int
     */
    private $id;
    /**
     * username of Cv
     * @var string
     */
    private $username;
    /**
     * name of Cv
     * @var string
     */
    private $name;
    /**
     * surname of Cv
     * @var string
     */
    private $surname;
    /**
     * age of cv
     * @var string
     */
    private $age;
    /**
     * address of cv
     * @var string
     */
    private $address;
    /**
     * experience of Cv
     * @var string
     */
    private $experience;
    /**
     * photo of Cv
     * @var string
     */
    private $photo;
    /**
     * extra of cv
     * @var string
     */
    private $extra;


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
     * get username
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
     * get name
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
     * get Surname
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * set surname
     * @param $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * get age
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * set age
     * @param $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * get address
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * set address
     * @param $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * get Experience
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * set Experience
     * @param $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    /**
     * get photo
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * set photo
     * @param $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * get extra
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * set extra
     * @param $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    /**
     * get one by username
     * @param $username
     * @return mixed|null
     */
    public static function getOneByUsername2($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM cvs WHERE username=:username';
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
     * update cv
     * @param DatabaseTable $object
     * @return bool
     */
    public static function updateCv(DatabaseTable $object)
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
     * delete cv
     * @param $username
     * @return bool
     */
    public static function deleteCv($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $statement = $connection->prepare('DELETE from ' . static::getTableName()  . ' WHERE username=:username');
        $statement->bindParam(':username', $username, \PDO::PARAM_INT);
        $queryWasSuccessful = $statement->execute();
        return $queryWasSuccessful;
    }



}