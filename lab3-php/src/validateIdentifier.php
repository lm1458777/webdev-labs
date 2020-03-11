<?php
declare(strict_types=1);

namespace lab3
{
    const IDENTIFIER_OK = 1;
    const IDENTIFIER_EMPTY = 2;
    const IDENTIFIER_MUST_START_WITH_LETTER = 3;
    const IDENTIFIER_CONTAINS_INVALID_SYMBOL = 4;

    function validateIdentifier(string $id): int
    {
        if ($id === "")
        {
            return IDENTIFIER_EMPTY;
        }

        if (!ctype_alpha($id[0]))
        {
            return IDENTIFIER_MUST_START_WITH_LETTER;
        }

        $idLength = strlen($id);
        for ($i = 1; $i < $idLength; $i++)
        {
            if (!ctype_alnum($id[$i]))
            {
                return IDENTIFIER_CONTAINS_INVALID_SYMBOL;
            }
        }

        return IDENTIFIER_OK;
    }
}
