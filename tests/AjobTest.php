<?php
/**
 * Created by PhpStorm.
 * User: Mark McCarthy
 * Date: 02/02/2016
 * Time: 16:20
 */

namespace Itb\tests;

use Itb\Model\Ajob;

class AjobTest extends \PHPUnit_Framework_TestCase
{
    public function testCanBeCreated()
    {
        // Arrange
        $a = new Ajob();

        // Act

        // Assert
        $this->assertNotNull($a);
    }

    public function testCanSetGetId()
    {
        // Arrange
        $a = new Ajob();
        $a->setId(1);
        $expectedResult = 1;

        // Act
        $result = $a->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetUsername()
    {
        // Arrange
        $a = new Ajob();
        $a->setUsername('Mark');
        $expectedResult = 'Mark';

        // Act
        $result = $a->getUsername();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetName()
    {
        // Arrange
        $a = new Ajob();
        $a->setName('Mark');
        $expectedResult = 'Mark';

        // Act
        $result = $a->getName();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
    public function testCanSetGetEmployerId()
    {
        // Arrange
        $a = new Ajob();
        $a->setEmployerId('001');
        $expectedResult = '001';

        // Act
        $result = $a->getEmployerId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetDeadline()
    {
        // Arrange
        $a = new Ajob();
        $a->setDeadline('19/06/2016');
        $expectedResult = '19/06/2016';

        // Act
        $result = $a->getDeadline();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetStudent()
    {
        // Arrange
        $a = new Ajob();
        $a->setStudent('Mark McCarthy');
        $expectedResult = 'Mark McCarthy';

        // Act
        $result = $a->getStudent();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }



}