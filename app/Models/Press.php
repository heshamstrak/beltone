<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Press extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image', 'video_url', 'type'];

    protected $appends = ['image_path'];

    //attir
    public function getImagePathAttribute()
    {
        return Storage::url('uploads/presses/' . $this->image);
        
    }// end of getImagePathAttribute
}
