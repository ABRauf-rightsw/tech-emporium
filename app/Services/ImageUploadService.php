<?php

namespace App\Services;

use App\Models\StoredImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    private const MAX_WIDTH = 1200;
    private const JPEG_QUALITY = 82;

    public function compressAndStore(UploadedFile $file, string $folder, ?Model $imageable = null): StoredImage
    {
        $disk = 'public';
        $filename = Str::uuid() . '.jpg';
        $relativePath = trim($folder, '/') . '/' . $filename;
        $absolutePath = Storage::disk($disk)->path($relativePath);

        if (! is_dir(dirname($absolutePath))) {
            mkdir(dirname($absolutePath), 0755, true);
        }

        $this->compressToJpeg($file, $absolutePath);

        $publicPath = 'storage/' . $relativePath;

        return StoredImage::create([
            'path' => $publicPath,
            'disk' => $disk,
            'folder' => $folder,
            'file_size' => filesize($absolutePath),
            'mime_type' => 'image/jpeg',
            'original_name' => $file->getClientOriginalName(),
            'imageable_type' => $imageable ? $imageable->getMorphClass() : null,
            'imageable_id' => $imageable?->getKey(),
        ]);
    }

    public function deleteByPath(?string $path): void
    {
        if (! $path || str_starts_with($path, 'assets/')) {
            return;
        }

        StoredImage::where('path', $path)->delete();

        $storagePath = str_replace('storage/', '', $path);
        if (Storage::disk('public')->exists($storagePath)) {
            Storage::disk('public')->delete($storagePath);
        }
    }

    public function replace(UploadedFile $file, string $folder, ?string $oldPath, ?Model $imageable = null): string
    {
        $this->deleteByPath($oldPath);

        return $this->compressAndStore($file, $folder, $imageable)->path;
    }

    private function compressToJpeg(UploadedFile $file, string $destination): void
    {
        if (! extension_loaded('gd')) {
            copy($file->getRealPath(), $destination);

            return;
        }

        $source = $this->createImageResource($file);
        if (! $source) {
            copy($file->getRealPath(), $destination);

            return;
        }

        $source = $this->applyExifOrientation($source, $file);

        $width = imagesx($source);
        $height = imagesy($source);

        if ($width > self::MAX_WIDTH) {
            $newWidth = self::MAX_WIDTH;
            $newHeight = (int) round($height * ($newWidth / $width));
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($source);
            $source = $resized;
        }

        imagejpeg($source, $destination, self::JPEG_QUALITY);
        imagedestroy($source);
    }

    private function createImageResource(UploadedFile $file)
    {
        $mime = $file->getMimeType();
        $path = $file->getRealPath();

        return match ($mime) {
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($path),
            'image/png' => imagecreatefrompng($path),
            'image/webp' => function_exists('imagecreatefromwebp') ? imagecreatefromwebp($path) : null,
            'image/gif' => imagecreatefromgif($path),
            default => null,
        };
    }

    /**
     * @param  \GdImage|resource  $resource
     * @return \GdImage|resource
     */
    private function applyExifOrientation($resource, UploadedFile $file)
    {
        if (! function_exists('exif_read_data')) {
            return $resource;
        }

        if (! in_array($file->getMimeType(), ['image/jpeg', 'image/jpg'], true)) {
            return $resource;
        }

        $exif = @exif_read_data($file->getRealPath());
        if (! isset($exif['Orientation'])) {
            return $resource;
        }

        $rotated = match ((int) $exif['Orientation']) {
            3 => imagerotate($resource, 180, 0),
            6 => imagerotate($resource, -90, 0),
            8 => imagerotate($resource, 90, 0),
            default => $resource,
        };

        if ($rotated !== $resource) {
            imagedestroy($resource);
        }

        return $rotated;
    }
}
