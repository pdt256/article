<?php
use pdt256\article\ReusableCode\User;
use pdt256\article\ReusableCode\UserPasswordValidator;

require_once realpath(__DIR__ . '/../../../') . '/vendor/autoload.php';

$newPassword = $argv[1];

$user = new User('John', 'Doe');
$userPasswordValidator = new UserPasswordValidator($user);

if ($userPasswordValidator->isValid($newPassword)) {
    echo 'Valid!' . PHP_EOL;
} else {
    echo '### INVALID! ###' . PHP_EOL;
}
