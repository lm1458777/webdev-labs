<?php
declare(strict_types=1);

namespace lab3
{
    function removeExtraSpaces(string $s): string
    {
        $values = preg_split("/\s+/", trim($s));
        return implode(" ", $values);
    }
}