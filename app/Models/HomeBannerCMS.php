<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeBannerCMS extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'home_banner_cms';

    protected $fillable = [
        'image',
        'title',
    ];

    // Accessor to get the full image URL
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}
