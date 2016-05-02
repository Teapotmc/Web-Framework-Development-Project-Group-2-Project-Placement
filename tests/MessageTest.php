<?php
/**
 * Created by PhpStorm.
 * User: Mark McCarthy
 * Date: 02/02/2016
 * Time: 16:20
 */

namespace Itb\tests;

use Itb\Model\Message;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testCanBeCreated()
    {
        // Arrange
        $m = new Message();

        // Act

        // Assert
        $this->assertNotNull($m);
    }

    public function testCanSetGetId()
    {
        // Arrange
        $m = new Message();
        $m->setId(1);
        $expectedResult = 1;

        // Act
        $result = $m->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetSubject()
    {
        // Arrange
        $m = new Message();
        $m->setSubject('Hello');
        $expectedResult = 'Hello';

        // Act
        $result = $m->getSubject();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetContent()
    {
        // Arrange
        $m = new Message();
        $m->setContent('Hello World');
        $expectedResult = 'Hello World';

        // Act
        $result = $m->getContent();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetComment()
    {
        // Arrange
        $m = new Message();
        $m->setComment('Everything looks fine');
        $expectedResult = 'Everything looks fine';

        // Act
        $result = $m->getComment();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

}