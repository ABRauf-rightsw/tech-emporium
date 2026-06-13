<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StoredImage extends Model
{
    protected $fillable = [
        'path', 'disk', 'folder', 'file_size', 'mime_type', 'original_name',
        'imageable_type', 'imageable_id',
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
