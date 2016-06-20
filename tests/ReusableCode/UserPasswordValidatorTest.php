<?php
namespace pdt256\article\ReusableCode;

class UserPasswordValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testPasswordHasValidLength()
    {
        $this->assertTrue($this->isValid('12345678'));
        $this->assertFalse($this->isValid('1234567'));
    }

    public function testPasswordCannotContainUsersName()
    {
        $this->assertTrue($this->isValid('^YUZ#*wFPys?k8eN'));
        $this->assertFalse($this->isValid('---john---'));
        $this->assertFalse($this->isValid('---doe----'));
    }

    private function isValid($password)
    {
        $user = new User('John', 'Doe');
        $userPasswordValidator = new UserPasswordValidator;

        try {
            $userPasswordValidator->assertPasswordValid($user, $password);
            return true;
        } catch (UserPasswordValidationException $e) {
            return false;
        }
    }
}
