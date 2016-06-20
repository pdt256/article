<?php
namespace pdt256\article\ReusableCode;

use Exception;

class UserPasswordValidationException extends Exception
{
    const TOO_SHORT = 1;
    const CONTAINS_USER_DETAILS = 2;

    public static function tooShort()
    {
        return new self('Password must be at least 8 characters', self::TOO_SHORT);
    }

    public static function containsUserDetails()
    {
        return new self('Password cannot contain user details', self::CONTAINS_USER_DETAILS);
    }
}
