<?php

declare(strict_types=1);

require_once("src/PersonInfoStorage.php");
require_once("src/FileSystem.php");
require_once("src/tryGetValue.php");

function dataDirectory(): string
{
    return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR;
}

function printPersonInfo(PersonInfo $info): void
{
    echo 'First Name: ' . $info->first_name . PHP_EOL;
    echo 'Last Name: ' . $info->last_name . PHP_EOL;
    echo 'Email: ' . $info->email . PHP_EOL;
    echo 'Age: ' . $info->age . PHP_EOL;
}

header("Content-Type: text/plain");

$email = tryGetValue($_REQUEST, 'email');
if ($email === null) {
    http_response_code(400);
    echo 'Invalid email' . PHP_EOL;
    return;
}

$storage = new PersonInfoStorage(dataDirectory(), new FileSystem());
$info = $storage->tryLoad($email);
if ($info === null) {
    http_response_code(404);
    return;
}

printPersonInfo($info);
