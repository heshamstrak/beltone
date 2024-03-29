<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image'];
    protected $appends = ['image_path'];

    //attir
    public function getImagePathAttribute()
    {
        return Storage::url('uploads/categories/' . $this->image);
        
    }// end of getImagePathAttribute

    public function business():HasMany
    {
        return $this->hasMany(Business::class, 'category_id');
    }

}
