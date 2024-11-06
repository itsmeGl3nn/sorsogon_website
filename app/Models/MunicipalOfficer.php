<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class MunicipalOfficer extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if the table name is pluralized automatically)
    protected $table = 'municipal_officer';

    // Define the fillable properties that can be mass-assigned
    protected $fillable = ['full_name', 'position', 'department', 'image'];

        // Accessor to get the full image URL
        public function getImageUrlAttribute()
        {
            return $this->image ? Storage::url($this->image) : null;
        }
}
