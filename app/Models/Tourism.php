<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tourism extends Model
{
    use HasFactory;

    protected $table = 'tourism';


    protected $fillable = [
        'title',
        'desc',
        'image',
    ];


    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}
