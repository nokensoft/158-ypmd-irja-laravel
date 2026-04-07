<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StorageFileController extends Controller
{
    /**
     * Serve file dari storage/app/public via PHP.
     * Fallback untuk hosting (cPanel) yang tidak support symlink.
     */
    public function show(string $path): BinaryFileResponse
    {
        $filePath = storage_path('app/public/' . $path);

        if (!file_exists($filePath) || !is_file($filePath)) {
            abort(404);
        }

        // Cegah path traversal
        $realBase = realpath(storage_path('app/public'));
        $realFile = realpath($filePath);

        if (!$realBase || !$realFile || !str_starts_with($realFile, $realBase)) {
            abort(403);
        }

        return response()->file($realFile, [
            'Cache-Control' => 'public, max-age=2592000',
        ]);
    }
}
