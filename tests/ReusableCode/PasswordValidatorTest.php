<?php
namespace pdt256\article\ReusableCode;

class PasswordValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testPasswordHasValidLength()
    {
        $passwordValidator = new PasswordLengthValidator();
        $this->assertTrue($passwordValidator->isValid('12345678'));
        $this->assertFalse($passwordValidator->isValid('1234567'));
    }
}
