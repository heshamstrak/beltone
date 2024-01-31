<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Business extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image', 'category_id'];
    protected $appends = ['image_path'];


    //attir
    public function getImagePathAttribute()
    {
        return Storage::url('uploads/businesses/' . $this->image);
        
    }// end of getImagePathAttribute

}
