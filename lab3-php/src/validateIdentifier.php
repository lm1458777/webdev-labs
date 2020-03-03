<?php
declare(strict_types=1);

namespace lab3
{
    const IDENTIFIER_OK = 1;
    const IDENTIFIER_EMPTY = 2;
    const IDENTIFIER_INVALID = 3;

    function validateIdentifier(string $s): int
    {
        if ($s === "")
        {
            return IDENTIFIER_EMPTY;
        }

        if (!ctype_alpha($s[0]))
        {
            return IDENTIFIER_INVALID;
        }

        $n = strlen($s);
        for ($i = 1; $i < $n; $i++)
        {
            if (!ctype_alnum($s[$i]))
            {
                return IDENTIFIER_INVALID;
            }
        }

        return IDENTIFIER_OK;
    }
}
