<?php

declare(strict_types=1);

function escapedString(string $value) : string
{
    $value = trim($value);
    $value = stripslashes($value);
    return htmlspecialchars($value);
}

function isNameValid(string $name) : bool
{
    $nameLength = mb_strlen($name);
    if ($nameLength < 1) {
        return false;
    }

    return (bool) preg_match('/^[A-Za-z]+([\ A-Za-z]+)*$/', $name);
}

function isEmailValid(string $email) : bool
{
    return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate(string $valueName, $validator) : string
{
    $value = $_POST[$valueName] ?? null;

    if (!empty($value) && $validator(escapedString($value))) {
        return 'correct';
    }

    return 'error';
}

function validateForm() : void
{
    header('Content-Type: application/json');

    $response = [
        'name' => validate('name', 'isNameValid'),
        'email' => validate('email', 'isEmailValid')
    ];

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
}

validateForm();
