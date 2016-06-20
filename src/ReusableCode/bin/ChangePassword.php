<?php
use pdt256\article\ReusableCode\User;
use pdt256\article\ReusableCode\UserPasswordValidationException;
use pdt256\article\ReusableCode\UserPasswordValidator;

require_once realpath(__DIR__ . '/../../../') . '/vendor/autoload.php';

$newPassword = $argv[1];

$user = new User('John', 'Doe');
$userPasswordValidator = new UserPasswordValidator($user);

try {
    $userPasswordValidator->assertPasswordValid($user, $newPassword);
} catch (UserPasswordValidationException $e) {
    die('### INVALID! ' . $e->getMessage() . ' ###' . PHP_EOL);
}

echo 'Valid!' . PHP_EOL;
