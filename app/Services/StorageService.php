<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageService
{
    /**
     * Upload a new file.
     *
     * @param  UploadedFile $file
     * @param  string $directory
     * @return string|null The file path of the uploaded file
     */
    public function upload(UploadedFile $file, string $directory = 'uploads'): ?string
    {
        return $file->store($directory, 'public');
    }

    /**
     * Update an existing file by deleting the old one and uploading a new one.
     *
     * @param  UploadedFile $newFile
     * @param  string|null $oldFilePath
     * @param  string $directory
     * @return string|null The file path of the updated file
     */
    public function update(UploadedFile $newFile, ?string $oldFilePath = null, string $directory = 'uploads'): ?string
    {
        // Delete the old file if it exists
        if ($oldFilePath) {
            $this->delete($oldFilePath);
        }

        // Upload the new file
        return $this->upload($newFile, $directory);
    }

    /**
     * Delete an existing file.
     *
     * @param  string|null $filePath
     * @return bool True if the file was deleted, false otherwise
     */
    public function delete(?string $filePath): bool
    {
        return $filePath ? Storage::disk('public')->delete($filePath) : false;
    }
}
