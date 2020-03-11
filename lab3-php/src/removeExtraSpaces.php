<?php
declare(strict_types=1);

namespace lab3
{
    function removeExtraSpaces(string $s): string
    {
        return (string) preg_replace("/\s+/", ' ', trim($s));
    }
}