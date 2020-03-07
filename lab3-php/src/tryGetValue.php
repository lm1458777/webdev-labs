<?php

declare(strict_types=1);

function tryGetValue(array $a, string $key): ?string
{
    if (isset($a[$key])) {
        $val = (string) $a[$key];
        if ($val !== '') {
            return $val;
        }
    }
    return null;
}
