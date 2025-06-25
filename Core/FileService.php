<?php

namespace Core;

class FileService
{
    public static function serve(string $url): void
    {
        // To solve "Not allowed to load local file" problem
        if (preg_match('#^/(image|file)/(.+)$#', $url, $matches)) {
            $type = $matches[1]; // image or file
            $fileName = basename($matches[2]);
            $filePath = urldecode(basePath("storage/{$type}s/$fileName"));

            if (file_exists($filePath)) {
                $mime = mime_content_type($filePath);
                header("Content-Type: $mime");
                header("Content-Length: " . filesize($filePath));
                readfile($filePath);
            } else {
                http_response_code(404);
                echo "Image not found.";
            }
            exit;
        }
    }
}