<?php
/**
 * Created by PhpStorm.
 * User: Mark McCarthy
 * Date: 02/02/2016
 * Time: 16:20
 */

namespace Itb\tests;

use Itb\Model\Pmessage;

class PmessageTest extends \PHPUnit_Framework_TestCase
{
    public function testCanBeCreated()
    {
        // Arrange
        $p = new Pmessage();

        // Act

        // Assert
        $this->assertNotNull($p);
    }

    public function testCanSetGetId()
    {
        // Arrange
        $p = new Pmessage();
        $p->setId(1);
        $expectedResult = 1;

        // Act
        $result = $p->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetUsername()
    {
        // Arrange
        $p = new Pmessage();
        $p->setUsername('Admin');
        $expectedResult = 'Admin';

        // Act
        $result = $p->getUsername();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetSubject()
    {
        // Arrange
        $p = new Pmessage();
        $p->setSubject('Hello');
        $expectedResult = 'Hello';

        // Act
        $result = $p->getSubject();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetContent()
    {
        // Arrange
        $p = new Pmessage();
        $p->setContent('Hello World');
        $expectedResult = 'Hello World';

        // Act
        $result = $p->getContent();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetComment()
    {
        // Arrange
        $p = new Pmessage();
        $p->setComment('Everything looks fine');
        $expectedResult = 'Everything looks fine';

        // Act
        $result = $p->getComment();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

}