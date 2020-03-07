<?php

declare(strict_types=1);

require_once("src/PersonInfoStorage.php");
require_once("src/FileSystem.php");
require_once("src/tryGetValue.php");

function dataDirectory(): string
{
    return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR;
}

header("Content-Type: text/plain");

$email = tryGetValue($_REQUEST, 'email');
if ($email === null) {
    http_response_code(400);
    echo 'Invalid email' . PHP_EOL;
    return;
}

$data = new PersonInfo();
$data->email = $email;
$data->first_name = tryGetValue($_REQUEST, 'first_name');
$data->last_name = tryGetValue($_REQUEST, 'last_name');
$data->age = tryGetValue($_REQUEST, 'age');

$storage = new PersonInfoStorage(dataDirectory(), new FileSystem());
$storage->save($data);
