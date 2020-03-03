<?php

declare(strict_types=1);

require_once("passwordStrength.php");

use PHPUnit\Framework\TestCase;
use function lab3\passwordStrength;

final class PasswordStrengthTest extends TestCase
{
    public function testPasswordStrength(): void
    {
        $this->assertSame(0, passwordStrength(""));
        $this->assertSame(3, passwordStrength("a"));
        $this->assertSame(10, passwordStrength("Ab"));
        $this->assertSame(15, passwordStrength("Abc"));
        $this->assertSame(3, passwordStrength("0"));
        $this->assertSame(16, passwordStrength("a01"));
        $this->assertSame(8+4+2-2, passwordStrength("a1a"));
        $this->assertSame(8+16+8-2-3, passwordStrength("a1222a"));
    }
}