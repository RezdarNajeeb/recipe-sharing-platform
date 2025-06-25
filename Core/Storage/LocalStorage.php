<?php

namespace Core\Storage;

class LocalStorage
{
    public static function save(?string $directory, string $inputName): ?string
    {
        $dirPath = self::getDirectoryPath($directory);

        if (!self::makeDirectory($dirPath)) {
            return null;
        }

        $randomName = self::generateRandomName(self::getOriginalFileName($inputName));
        $targetPath = self::buildFilePath($dirPath, $randomName);

        if (!self::isFileAllowed($inputName)) {
            return null;
        }

        if (!move_uploaded_file(self::getTempPath($inputName), $targetPath)) {
            return null;
        }

        return $randomName;
    }

    public static function update(?string $directory, string $inputName, ?string $existingFile = null): ?string
    {
        if (!self::isUploaded($inputName)) {
            return $existingFile;
        }

        $newFile = self::save($directory, $inputName);

        if ($newFile && $existingFile) {
            $existingFilePath = self::getDirectoryPath($directory) . $existingFile;
            if (file_exists($existingFilePath)) {
                unlink($existingFilePath);
            }
        }

        return $newFile;
    }

    public static function delete(string $directory, string $fileName): void
    {
        if (!$fileName) return;

        $filePath = self::getDirectoryPath($directory) . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public static function isUploaded(string $inputName): bool
    {
        return isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK;
    }

    public static function getDirectoryPath(?string $directory): string
    {
        return basePath("storage/$directory/");
    }

    public static function makeDirectory(string $dirPath): bool
    {
        return file_exists($dirPath) || mkdir($dirPath, 0777, true);
    }

    public static function buildFilePath(string $dirPath, string $fileName): string
    {
        return $dirPath . $fileName;
    }

    public static function getOriginalFileName(string $inputName): string
    {
        return basename($_FILES[$inputName]['name']);
    }

    public static function generateRandomName(string $originalName): string
    {
        return time() . '_' . bin2hex(random_bytes(6)) . '.' . self::getExtension($originalName);
    }

    public static function isFileAllowed(string $inputName): bool
    {
        if ($_FILES[$inputName]['size'] > 10 * 1024 * 1024) {
            echo "File is too large.";
            return false;
        }

        $mimeType = mime_content_type($_FILES[$inputName]['tmp_name']);
        $allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/jpg',
            'application/pdf'
        ];

        if (!in_array($mimeType, $allowedTypes)) {
            echo "Only JPG, JPEG, PNG, and PDF files are allowed.";
            return false;
        }

        return true;
    }

    public static function getExtension(string $fileName): string
    {
        return strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    }

    public static function getTempPath(string $inputName): mixed
    {
        return $_FILES[$inputName]['tmp_name'];
    }
}