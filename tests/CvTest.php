<?php
/**
 * Created by PhpStorm.
 * User: Mark McCarthy
 * Date: 02/02/2016
 * Time: 16:20
 */

namespace Itb\tests;

use Itb\Model\Cv;

class CvTest extends \PHPUnit_Framework_TestCase
{
    public function testCanBeCreated()
    {
        // Arrange
        $c = new Cv();

        // Act

        // Assert
        $this->assertNotNull($c);
    }

    public function testCanSetGetId()
    {
        // Arrange
        $c = new Cv();
        $c->setId(1);
        $expectedResult = 1;

        // Act
        $result = $c->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetUsername()
    {
        // Arrange
        $c = new Cv();
        $c->setUsername('Mark');
        $expectedResult = 'Mark';

        // Act
        $result = $c->getUsername();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetName()
    {
        // Arrange
        $c = new Cv();
        $c->setName('Mark');
        $expectedResult = 'Mark';

        // Act
        $result = $c->getName();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetSurname()
    {
        // Arrange
        $c = new Cv();
        $c->setSurname('McCarthy');
        $expectedResult = 'McCarthy';

        // Act
        $result = $c->getSurname();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetAge()
    {
        // Arrange
        $c = new Cv();
        $c->setAge('22');
        $expectedResult = '22';

        // Act
        $result = $c->getAge();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetAddress()
    {
        // Arrange
        $c = new Cv();
        $c->setAddress('WhiteWell Gaybrook');
        $expectedResult = 'WhiteWell Gaybrook';

        // Act
        $result = $c->getAddress();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetExperience()
    {
        // Arrange
        $c = new Cv();
        $c->setExperience('None');
        $expectedResult = 'None';

        // Act
        $result = $c->getExperience();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetPhoto()
    {
        // Arrange
        $c = new Cv();
        $c->setPhoto('headshot.jpg');
        $expectedResult = 'headshot.jpg';

        // Act
        $result = $c->getPhoto();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }


    public function testCanSetGetExtra()
    {
        // Arrange
        $c = new Cv();
        $c->setExtra('I like Video Games');
        $expectedResult = 'I like Video Games';

        // Act
        $result = $c->getExtra();

        // Assert
        $this->assertEquals($expectedResult, $result);


    }

}