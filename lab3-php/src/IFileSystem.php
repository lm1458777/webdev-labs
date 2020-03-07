<?php

declare(strict_types=1);

interface IFileSystem {
    public function writeFile(string $filePath, string $content): void;
    public function tryReadFile(string $filePath): ?string;
}