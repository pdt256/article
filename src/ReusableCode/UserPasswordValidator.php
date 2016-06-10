<?php
namespace pdt256\article\ReusableCode;

class UserPasswordValidator implements PasswordValidatorInterface
{
    /** @var PasswordValidatorInterface */
    private $passwordValidator;

    /** @var User */
    private $user;

    public function __construct(PasswordValidatorInterface $passwordValidator, User $user)
    {
        $this->passwordValidator = $passwordValidator;
        $this->user = $user;
    }

    public function isValid(string $password) : bool
    {
        return $this->passwordValidator->isValid($password)
            && $this->passwordDoesNotContainUserDetails($password);
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
