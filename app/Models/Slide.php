<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'link'];

    protected $appends = ['image_path'];

    //attir
    public function getImagePathAttribute()
    {
        return Storage::url('uploads/slides/' . $this->image);
        
    }// end of getImagePathAttribute

}
