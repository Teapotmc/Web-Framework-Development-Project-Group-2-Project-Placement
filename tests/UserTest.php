<?php
/**
 * Created by PhpStorm.
 * User: Mark McCarthy
 * Date: 02/02/2016
 * Time: 16:20
 */

namespace Itb\tests;

use Itb\Model\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testCanBeCreated()
    {
        // Arrange
        $u = new User();

        // Act

        // Assert
        $this->assertNotNull($u);
    }

    public function testCanSetGetId()
    {
        // Arrange
        $u = new User();
        $u->setId(1);
        $expectedResult = 1;

        // Act
        $result = $u->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetUsername()
    {
        // Arrange
        $u = new User();
        $u->setUsername('mark');
        $expectedResult = 'mark';

        // Act
        $result = $u->getUsername();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetRole()
    {
        // Arrange
        $u = new User();
        $u->setRole('1');
        $expectedResult = '1';

        // Act
        $result = $u->getRole();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanSetGetpassword()
    {
        // Arrange
        $u = new User();
        $password = "password";
        $expectedResult = $password;

        $u->setPassword( $expectedResult);

        // Act
        $result = $u->getPassword();
        $bool = password_verify("password", $result);
        // Assert
        $this->assertTrue($bool);
    }
    

}