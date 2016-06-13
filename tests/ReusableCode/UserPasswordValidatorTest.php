<?php
namespace pdt256\article\ReusableCode;

class UserPasswordValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserPasswordValidator */
    private $userPasswordValidator;

    protected function setUp()
    {
        parent::setUp();

        $user = new User('John', 'Doe');
        $this->userPasswordValidator = new UserPasswordValidator($user);
    }

    public function testPasswordHasValidLength()
    {
        $this->assertTrue($this->userPasswordValidator->isValid('12345678'));
        $this->assertFalse($this->userPasswordValidator->isValid('1234567'));
    }

    public function testPasswordCannotContainUsersName()
    {
        $this->assertTrue($this->userPasswordValidator->isValid('^YUZ#*wFPys?k8eN'));
        $this->assertFalse($this->userPasswordValidator->isValid('---john---'));
        $this->assertFalse($this->userPasswordValidator->isValid('---doe----'));
    }
}
