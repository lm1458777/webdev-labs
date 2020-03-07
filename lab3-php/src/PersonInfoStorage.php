<?php

declare(strict_types=1);

require_once("src/PersonInfo.php");
require_once("src/PersonInfoSerializer.php");
require_once("src/IFileSystem.php");

class PersonInfoStorage
{
    private $rootDir;
    private $fs;

    public function __construct(string $rootDir, IFileSystem $fs)
    {
        $this->rootDir = $rootDir;
        $this->fs = $fs;
    }

    public function save(PersonInfo $info): void
    {
        $s = PersonInfoSerializer::serialize($info);
        $filePath = $this->filePath($info->email);
        $this->fs->writeFile($filePath, $s);
    }

    public function tryLoad(string $id): ?PersonInfo
    {
        $filePath = $this->filePath($id);
        $s = $this->fs->tryReadFile($filePath);
        if ($s === null) {
            return null;
        }

        return PersonInfoSerializer::unserialize($s);
    }

    private function filePath(string $id) : string
    {
        return $this->rootDir . $id . ".txt";
    }
}