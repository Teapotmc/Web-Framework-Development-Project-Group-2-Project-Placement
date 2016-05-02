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
 * represents message details
 * Class Message
 * @package Itb\Model
 */
class Message extends DatabaseTable
{
    /**
     * represents id
     * @var int
     */
    private $id;
    /** represents subject
     * @var string
     */
    private $subject;
    /**
     * represents content
     * @var string
     */
    private $content;
    /**
     * represents comment
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
     * get subject
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * set subject
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
     * set content
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * get comment
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * set comment
     * @param $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * gets all messages backwards
     * @return array
     */
    public static function getAllMessage()
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * from ' . static::getTableName().' ORDER BY id DESC';

        $statement = $connection->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\' .  static::class);
        $statement->execute();

        $objects = $statement->fetchAll();
        return $objects;
    }

}
