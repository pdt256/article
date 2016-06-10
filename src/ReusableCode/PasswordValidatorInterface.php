<?php
namespace pdt256\article\ReusableCode;

interface PasswordValidatorInterface
{
    public function isValid(string $password) : bool;
}
