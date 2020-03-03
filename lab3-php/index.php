<?php

declare(strict_types=1);

require_once("src/removeExtraSpaces.php");
require_once("src/validateIdentifier.php");
require_once("src/passwordStrength.php");

function removeExtraBlanks(): void
{
    $text = $_REQUEST["text"];
    if ($text) {
        echo "text: '" . lab3\removeExtraSpaces($text) . "'" . PHP_EOL;
    }
}

function validateIdentifier(): void
{
    $identifier = $_REQUEST["identifier"];
    if ($identifier === null) {
        return;
    }

    echo "identifier: '" . $identifier . "' ";

    switch (lab3\validateIdentifier($identifier)) {
        case lab3\IDENTIFIER_OK:
            echo "yes.";
        break;
        case lab3\IDENTIFIER_EMPTY:
            echo "no" . ". Identifier must not be empty.";
        break;
        case lab3\IDENTIFIER_INVALID:
            echo "no" . ". Identifier must start with a letter.";
        break;
    }

    echo PHP_EOL;
}

function passwordStrength(): void
{
    $password = $_REQUEST["password"];
    if ($password === null)
    {
        return;
    }

    if (!lab3\isValidPassword($password))
    {
        echo "Password must contain alphanumeric characters only." . PHP_EOL;
        return;
    }

    echo "Password strength: " . lab3\passwordStrength($password) . PHP_EOL;
}

header("Content-Type: text/plain");

echo "Hello, world!" . PHP_EOL;

removeExtraBlanks();
validateIdentifier();
passwordStrength();
