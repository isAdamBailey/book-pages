<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_number',
        'content',
        'image_path'
    ];

    public function getImagePathAttribute($value): string
    {
        if (Str::startsWith($value, 'https://')) {
            return $value;
        }

        return Storage::url($value);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
