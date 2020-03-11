<?php

declare(strict_types=1);

require_once("src/PersonInfo.php");
require_once("src/tryGetValue.php");

class PersonInfoSerializer
{
    public static function serialize(PersonInfo $info): string
    {
        $data = [
            'email' => (string) $info->email,
            'first_name' => (string) $info->first_name,
            'last_name' => (string) $info->last_name,
            'age' => (string) $info->age
        ];

        return (string) json_encode($data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    }

    public static function unserialize(string $s): ?PersonInfo
    {
        $data = json_decode($s, true);
        if ($data === null) {
            return null;
        }

        $info = new PersonInfo();
        $info->email = tryGetValue($data, 'email');
        $info->first_name = tryGetValue($data, 'first_name');
        $info->last_name = tryGetValue($data, 'last_name');
        $info->age = tryGetValue($data, 'age');

        return $info;
    }
}