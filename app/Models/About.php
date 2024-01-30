<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class About extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image'];

    protected $appends = ['image_path'];

    //attir
    public function getImagePathAttribute()
    {
        return Storage::url('uploads/abouts/' . $this->image);
        
    }// end of getImagePathAttribute

}
