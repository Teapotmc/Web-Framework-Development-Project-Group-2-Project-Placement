<?php
/**
 * Created by PhpStorm.
 * User: Mark McCarthy
 * Date: 02/02/2016
 * Time: 16:20
 */

namespace Itb\tests;

use Itb\Model\Student;

class StudentTest extends \PHPUnit_Framework_TestCase
{
    public function testCanBeCreated()
    {
        // Arrange
        $s = new Student();

        // Act

        // Assert
        $this->assertNotNull($s);
    }

    public function testCanSetGetId()
    {
        // Arrange
        $s = new Student();
        $s->setId(1);
        $expectedResult = 1;

        // Act
        $result = $s->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetUsername()
    {
        // Arrange
        $s = new Student();
        $s->setUsername('mark');
        $expectedResult = 'mark';

        // Act
        $result = $s->getUsername();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }


    public function testCanSetGetEmployed()
    {
        // Arrange
        $s = new Student();
        $s->setEmployed(Student::EMPLOYED_EMPLOYED);
        $expectedResult = 'Employed';

        // Act
        $result = $s->getEmployed();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

}