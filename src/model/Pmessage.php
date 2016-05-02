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
 * represents details of Pmessages
 * Class Pmessage
 * @package Itb\Model
 */
class Pmessage extends DatabaseTable
{
    /**
     * represents id of Pmessae
     * @var int
     */
    private $id;
    /**
     * represents username of Pmessage
     * @var string
     */
    private $username;
    /**
     * represents subject of Pmessage
     * @var string
     */
    private $subject;
    /**
     * represents content of Pmessage
     * @var string
     */
    private $content;
    /**
     * represents comment of Pmessage
     * @var string
     */
    private $comment;

    /**
     * get id
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
     * @return stromg
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
     * gets subject
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * sets subject
     * @param $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * get content
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * sets content
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * gets comment
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * sets comment
     * @param $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * gets one by Username
     * @param $username
     * @return mixed|null
     */
    public static function getOneByUsername($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM pmessages WHERE username=:username';
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
     * search by column
     * @param $columnName
     * @param $searchText
     * @return array
     */
    public static function searchByColumnPmessage($columnName, $searchText)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        // wrap wildcard '%' around the serach text for the SQL query
        $searchText = '%' . $searchText . '%';

        $statement = $connection->prepare('SELECT * from pmessages WHERE ' . $columnName . ' LIKE :searchText ORDER BY id DESC');
        $statement->bindParam(':searchText', $searchText, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\' .  static::class);
        $statement->execute();

        $objects = $statement->fetchAll();

        return $objects;
    }

}
