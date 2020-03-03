<?php

declare(strict_types=1);

require_once("removeExtraSpaces.php");

use PHPUnit\Framework\TestCase;
use function lab3\removeExtraSpaces;

final class RemoveExtraSpacesTest extends TestCase
{
    public function testRemoveExtraSpaces(): void
    {
        $this->assertSame("", removeExtraSpaces(""));
        $this->assertSame("test", removeExtraSpaces("test"));
        $this->assertSame("test 2 3", removeExtraSpaces(" test  2   3    "));
    }
}
