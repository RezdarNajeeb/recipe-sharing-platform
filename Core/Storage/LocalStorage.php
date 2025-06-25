<?php

namespace Core\Storage;

class LocalStorage
{
    public static function save(?string $path, string $file): bool
    {
        $targetDir = self::getDirPath($path);

        if (!self::makeDir($targetDir)) {
            return false;
        }

        $targetFile = self::getFilePath($targetDir, $file);

        if (!self::isFileAllowed($targetFile, $file)) {
            return false;
        }

        if (!move_uploaded_file(self::getTempFile($file), $targetFile)) {
            return false;
        }

        return true;
    }

    public static function getDirPath(?string $path): string
    {
        return basePath("storage/$path/");
    }

    public static function makeDir(string $targetDir): bool
    {
        if (!file_exists($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                return false;
            }
        }
        return true;
    }

    public static function getFilePath(string $targetDir, string $file): string
    {
        return $targetDir.self::getFileName($file);
    }

    public static function getFileName(string $file): string
    {
        return basename($_FILES[$file]['name']);
    }

    public static function getRandomName(string $file): void
    {
        //
    }

    public static function isFileAllowed(string $targetFile, string $file): bool
    {
        $isAllowed = true;

        if (file_exists($targetFile)) {
            echo "Sorry, file already exists";
            $isAllowed = false;
        }

        if ($_FILES[$file]['size'] > 10485760) { // 10MB in bytes
            echo "Sorry, your file is too large.";
            $isAllowed = false;
        }

        if (!in_array(self::getFileType($targetFile), ['jpg', 'png', 'jpeg', 'pdf'])) {
            echo "Sorry, only JPG, JPEG, PNG and pdf files are allowed.";
            $isAllowed = false;
        }

        return $isAllowed;
    }

    public static function getFileType(string $targetFile): string
    {
        return strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    }

    public static function getTempFile(string $file): mixed
    {
        return $_FILES[$file]['tmp_name'];
    }
}