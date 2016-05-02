<?php
/**
 * Created by PhpStorm.
 * User: Mark McCarthy
 * Date: 02/02/2016
 * Time: 16:20
 */

namespace Itb\tests;

use Itb\Model\Job;

class JobTest extends \PHPUnit_Framework_TestCase
{
    public function testCanBeCreated()
    {
        // Arrange
        $j = new Job();

        // Act

        // Assert
        $this->assertNotNull($j);
    }

    public function testCanSetGetId()
    {
        // Arrange
        $j = new Job();
        $j->setId(1);
        $expectedResult = 1;

        // Act
        $result = $j->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetDetails()
    {
        // Arrange
        $j = new Job();
        $j->setDetails('Need new Logo');
        $expectedResult = 'Need new Logo';

        // Act
        $result = $j->getDetails();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetName()
    {
        // Arrange
        $j = new Job();
        $j->setName('Mark');
        $expectedResult = 'Mark';

        // Act
        $result = $j->getName();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
    public function testCanSetGetEmployerId()
    {
        // Arrange
        $j = new Job();
        $j->setEmployerId('001');
        $expectedResult = '001';

        // Act
        $result = $j->getEmployerId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetDeadline()
    {
        // Arrange
        $j = new Job();
        $j->setDeadline('19/06/2016');
        $expectedResult = '19/06/2016';

        // Act
        $result = $j->getDeadline();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

}