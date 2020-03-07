<?php

declare(strict_types=1);

require_once("src/IFileSystem.php");

class FileSystem implements IFileSystem
{
    public function writeFile(string $filePath, string $content): void
    {
        self::createFileDirectory($filePath);
        file_put_contents($filePath, $content);
    }

    public function tryReadFile(string $filePath): ?string
    {
        if (!is_file($filePath)) {
            return null;
        }

        $result = file_get_contents($filePath);
        if ($result === false) {
            return null;
        }

        return (string) $result;
    }

    private static function createFileDirectory(string $fullPath)
    {
        $parts = explode('/', $fullPath);
        array_pop($parts);
        $dir = implode('/', $parts);
   
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}