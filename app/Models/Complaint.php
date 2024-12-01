<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory, SoftDeletes;

    // Specify the table name if it doesn't follow the Laravel convention
    protected $table = 'complaints';

    // Define the fillable fields
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'complaint',
        'mobile_num',
        'email',
        'proof'
    ];

    public function getImageUrlAttribute()
    {
        return $this->proof ? Storage::url($this->proof) : null;
    }
}
