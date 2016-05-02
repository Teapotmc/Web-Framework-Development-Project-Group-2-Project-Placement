<?php
/**
 * Created by PhpStorm.
 * User: Mark McCarthy
 * Date: 02/02/2016
 * Time: 16:20
 */

namespace Itb\tests;

use Itb\Model\Employer;

class EmployerTest extends \PHPUnit_Framework_TestCase
{
    public function testCanBeCreated()
    {
        // Arrange
        $e = new Employer();

        // Act

        // Assert
        $this->assertNotNull($e);
    }

    public function testCanSetGetId()
    {
        // Arrange
        $e = new Employer();
        $e->setId(1);
        $expectedResult = 1;

        // Act
        $result = $e->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetUsername()
    {
        // Arrange
        $e = new Employer();
        $e->setUsername('Mark');
        $expectedResult = 'Mark';

        // Act
        $result = $e->getUsername();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetEmployerId()
    {
        // Arrange
        $e = new Employer();
        $e->setEmployerId('001');
        $expectedResult = '001';

        // Act
        $result = $e->getEmployerId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}