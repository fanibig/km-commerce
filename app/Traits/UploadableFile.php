<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;

trait UploadableFile
{
    public function uploadOne($file, $folder = null, $disk = 'public', $filename = null): mixed
    {
        $filename = Str::uuid() . '_' . $filename;
        return $file->store($folder, [
            'disk' => $disk,
            'filename' => $filename,
        ]);
    }

    public function uploadMany($files, $folder = null, $disk = 'public'): array
    {
        foreach ($files as $file) {
            $filename = Str::uuid() . '-' . $file->getClientOriginalName();
            $file->storeAs($folder, $filename, ['disk' => $disk]);
            $data[] = $filename;
        }
        return $data;
    }

    /**
     * Upload and optimize an image.
     *
     * @param mixed $image The image file to upload.
     * @param string $directory The directory to store the image.
     * @param string $extension The default extension for the image.
     * @param array $mimes Allowed mime types for the image.
     * @return string|false The stored image path or false on failure.
     */
    public function uploadImage($image, $directory = 'uploads', $extension = 'jpg', $mimes = ['jpg', 'png', 'jpeg', 'svg', 'webp', 'gif'])
    {
        try {
            if (!$image || !in_array($image->getClientOriginalExtension(), $mimes)) {
                throw new Exception('Invalid image file or unsupported file type.');
            }

            // Generate unique filename with the specified extension
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $originalName . '_' . time() . '.' . $extension;

            // Store the image in the specified directory
            $storedPath = $image->storeAs($directory, $filename, 'public');

            // Optimize the stored image
            $fullPath = Storage::disk('public')->path($storedPath);
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($fullPath);

            // Return the stored path
            return $storedPath;
        } catch (Exception $e) {
            // Log the error and return the message for debugging
            Log::error('Image upload failed: ' . $e->getMessage());
            return false;
        }
    }

    public function updateUploadImage($newImage, $existingImagePath, $directory = 'uploads', $extension = 'jpg', $mimes = ['jpg', 'png', 'jpeg', 'svg', 'webp', 'gif'])
    {
        try {
            // Check if the new image is valid
            if (!$newImage || !in_array($newImage->getClientOriginalExtension(), $mimes)) {
                throw new Exception('Invalid image file or unsupported file type.');
            }

            // Delete the existing image if it exists
            if ($existingImagePath && Storage::disk('public')->exists($existingImagePath)) {
                Storage::disk('public')->delete($existingImagePath);
            }

            // Ensure the custom directory exists
            $directory = rtrim($directory, '/'); // Remove trailing slash if present
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Generate unique filename with the specified extension
            $originalName = pathinfo($newImage->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $originalName . '_' . time() . '.' . $extension;

            // Store the new image in the specified directory
            $storedPath = $newImage->storeAs($directory, $filename, 'public');

            // Optimize the stored image
            $fullPath = Storage::disk('public')->path($storedPath);
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($fullPath);

            // Return the new image path
            return $storedPath;
        } catch (Exception $e) {
            // Log the error and return the message for debugging
            Log::error('Image update failed: ' . $e->getMessage());
            return false;
        }
    }
}