<?php

declare(strict_types=1);

namespace lab3
{
    function isValidPassword(string $pwd): bool
    {
        $n = strlen($pwd);
        for ($i = 0; $i < $n; $i++) {
            if (!ctype_alnum($pwd[$i])) {
                return false;
            }
        }
        return true;
    }

    function passwordStrength(string $pwd): int
    {
        if (!isValidPassword($pwd)) {
            return 0;
        }

        $symbols = count_chars($pwd);

        $nLowercaseChars = 0;
        $nUppercaseChars = 0;
        $nDigits = 0;
        foreach ($symbols as $ch => $n) {
            if (ctype_lower($ch)) {
                $nLowercaseChars += $n;
            } elseif (ctype_upper($ch)) {
                $nUppercaseChars += $n;
            } elseif (ctype_digit($ch)) {
                $nDigits += $n;
            }
        }

        $nChars = $nUppercaseChars + $nLowercaseChars;
        $len = strlen($pwd);

        $strength = 0;

        $strength += 4 * $nChars;

        $strength += 4 * $nDigits;

        if ($nUppercaseChars > 0) {
            $strength += 2 * ($len - $nUppercaseChars);
        }

        if ($nLowercaseChars > 0) {
            $strength += 2 * ($len - $nLowercaseChars);
        }

        if ($len === $nChars) {
            $strength -= $nChars;
        }

        if ($len == $nDigits) {
            $strength -= $nDigits;
        }

        foreach ($symbols as $ch => $n) {
            if ($n > 1) {
                $strength -= $n;
            }
        }

        return $strength;
    }
}
