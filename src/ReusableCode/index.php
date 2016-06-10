<?php
use pdt256\article\ReusableCode\PasswordLengthValidator;
use pdt256\article\ReusableCode\User;
use pdt256\article\ReusableCode\UserPasswordValidator;

$basePath = realpath(__DIR__ . '/../..');
require_once $basePath . '/vendor/autoload.php';

$firstName = 'John';
$lastName = 'Doe';
$password1 = 'V3ryS3cureP4sswOrd!';
$password2 = 'johndoepassword!';

$user = new User($firstName, $lastName);
$userPasswordValidator = new UserPasswordValidator(
    new PasswordLengthValidator(),
    $user
);

$isPassword1Valid = $userPasswordValidator->isValid($password1);
$isPassword2Valid = $userPasswordValidator->isValid($password2);

include_once 'View/index.php';
