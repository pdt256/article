<?php
namespace pdt256\article\ReusableCode;

class UserPasswordValidator
{
    /** @var User */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function isValid(string $password) : bool
    {
        return $this->isPasswordLengthValid($password)
            && $this->passwordDoesNotContainUserDetails($password);
    }

    private function isPasswordLengthValid(string $password) : bool
    {
        return strlen($password) >= 8;
    }

    private function passwordDoesNotContainUserDetails(string $password) : bool
    {
        return ! $this->passwordContainsNeedle($password, $this->user->getFirstName())
            && ! $this->passwordContainsNeedle($password, $this->user->getLastName());
    }

    private function passwordContainsNeedle(string $password, string $needle) : bool
    {
        return stripos($password, $needle) !== false;
    }
}
