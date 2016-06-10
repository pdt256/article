<?php
namespace pdt256\article\ReusableCode;

class PasswordLengthValidator implements PasswordValidatorInterface
{
    public function isValid(string $password) : bool
    {
        return $this->isPasswordLengthValid($password);
    }

    private function isPasswordLengthValid(string $password) : bool
    {
        return strlen($password) >= 8;
    }
}
