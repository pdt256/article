<?php
namespace pdt256\article\ReusableCode;

class UserPasswordValidator
{
    public function assertPasswordValid(User $user, string $password)
    {
        $this->assertPasswordLengthValid($password);
        $this->assertPasswordDoesNotContainUserDetails($user, $password);
    }

    private function assertPasswordLengthValid(string $password)
    {
        if (strlen($password) < 8) {
            throw UserPasswordValidationException::tooShort();
        }
    }

    private function assertPasswordDoesNotContainUserDetails(User $user, string $password)
    {
        if ($this->passwordContainsUserDetails($user, $password)) {
            throw UserPasswordValidationException::containsUserDetails();
        }
    }

    private function passwordContainsUserDetails(User $user, string $password): bool
    {
        return $this->passwordContainsNeedle($password, $user->getFirstName())
            || $this->passwordContainsNeedle($password, $user->getLastName());
    }

    private function passwordContainsNeedle(string $password, string $needle) : bool
    {
        return stripos($password, $needle) !== false;
    }
}
