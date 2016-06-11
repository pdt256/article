<?php
namespace pdt256\article\ReusableCode;

class UserPasswordValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testPasswordCannotContainUserName()
    {
        $user = new User('John', 'Doe');

        $userPasswordValidator = new UserPasswordValidator(
            new PasswordLengthValidator(),
            $user
        );

        $this->assertTrue($userPasswordValidator->isValid('^YUZ#*wFPys?k8eN'));
        $this->assertFalse($userPasswordValidator->isValid('---john---'));
        $this->assertFalse($userPasswordValidator->isValid('---doe----'));
    }
}
