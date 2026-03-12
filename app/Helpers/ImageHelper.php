<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * Generate a storage-safe filename: YYYY_MM_DD_HHmmss_randomslug.ext
     */
    public static function generateFilename(string $extension): string
    {
        return date('Y_m_d_His') . '_' . Str::random(10) . '.' . ltrim($extension, '.');
    }
    /**
     * Process an uploaded image: convert to WebP and resize.
     * - Landscape: max width 720px
     * - Portrait:  max height 720px
     *
     * @param  UploadedFile  $file
     * @param  string  $directory  Storage subdirectory (e.g. 'media', 'situs')
     * @param  int  $maxDimension  Max width/height in pixels
     * @return array  ['path' => string, 'size' => int]
     */
    public static function processAndStore(UploadedFile $file, string $directory = 'media', int $maxDimension = 720): array
    {
        $image = self::createImageFromFile($file->getRealPath(), $file->getMimeType());

        if (!$image) {
            // Fallback: store original if GD can't process it
            $ext = $file->getClientOriginalExtension() ?: 'bin';
            $filename = self::generateFilename($ext);
            $path = $file->storeAs($directory, $filename, 'public');
            return ['path' => $path, 'size' => $file->getSize()];
        }

        $origWidth = imagesx($image);
        $origHeight = imagesy($image);

        // Determine new dimensions
        $newWidth = $origWidth;
        $newHeight = $origHeight;

        if ($origWidth >= $origHeight) {
            // Landscape or square: limit width
            if ($origWidth > $maxDimension) {
                $newWidth = $maxDimension;
                $newHeight = (int) round($origHeight * ($maxDimension / $origWidth));
            }
        } else {
            // Portrait: limit height
            if ($origHeight > $maxDimension) {
                $newHeight = $maxDimension;
                $newWidth = (int) round($origWidth * ($maxDimension / $origHeight));
            }
        }

        // Resize if needed
        if ($newWidth !== $origWidth || $newHeight !== $origHeight) {
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
            imagedestroy($image);
            $image = $resized;
        }

        // Generate WebP filename
        $filename = self::generateFilename('webp');
        $relativePath = $directory . '/' . $filename;
        $absolutePath = Storage::disk('public')->path($relativePath);

        // Ensure directory exists
        $dirPath = dirname($absolutePath);
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0755, true);
        }

        // Save as WebP (quality 85)
        imagewebp($image, $absolutePath, 85);
        imagedestroy($image);

        $fileSize = filesize($absolutePath);

        return [
            'path' => $relativePath,
            'size' => $fileSize,
        ];
    }

    /**
     * Create a GD image resource from file path based on MIME type.
     */
    private static function createImageFromFile(string $path, string $mimeType)
    {
        return match ($mimeType) {
            'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($path),
            'image/png' => self::createFromPng($path),
            'image/gif' => @imagecreatefromgif($path),
            'image/webp' => @imagecreatefromwebp($path),
            default => null,
        };
    }

    /**
     * Create image from PNG preserving transparency.
     */
    private static function createFromPng(string $path)
    {
        $image = @imagecreatefrompng($path);
        if ($image) {
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }
        return $image;
    }
}
