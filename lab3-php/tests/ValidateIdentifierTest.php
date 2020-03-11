<?php

declare(strict_types=1);

require_once("validateIdentifier.php");

use PHPUnit\Framework\TestCase;
use function lab3\validateIdentifier;

final class ValidateIdentifierTest extends TestCase
{
    public function testValidation(): void
    {
        $this->assertSame(lab3\IDENTIFIER_EMPTY, validateIdentifier(""));
        $this->assertSame(lab3\IDENTIFIER_MUST_START_WITH_LETTER, validateIdentifier("_"));
        $this->assertSame(lab3\IDENTIFIER_MUST_START_WITH_LETTER, validateIdentifier("1"));
        $this->assertSame(lab3\IDENTIFIER_MUST_START_WITH_LETTER, validateIdentifier("1a"));
        $this->assertSame(lab3\IDENTIFIER_CONTAINS_INVALID_SYMBOL, validateIdentifier("a_1"));
        $this->assertSame(lab3\IDENTIFIER_CONTAINS_INVALID_SYMBOL, validateIdentifier("a1@a2"));
        $this->assertSame(lab3\IDENTIFIER_OK, validateIdentifier("a"));
        $this->assertSame(lab3\IDENTIFIER_OK, validateIdentifier("abcd"));
        $this->assertSame(lab3\IDENTIFIER_OK, validateIdentifier("b123"));
    }
}
