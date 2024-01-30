<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'job', 'phone', 'image', 'facebook_link', 'twitter_link', 'linkedin_link'];

    protected $appends = ['image_path'];

    //attir
    public function getImagePathAttribute()
    {
        return Storage::url('uploads/teams/' . $this->image);
        
    }// end of getImagePathAttribute
}
