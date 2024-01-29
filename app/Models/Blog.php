<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'poster'];
    protected $appends = ['poster_path'];

    //attr
    public function getPosterPathAttribute()
    {
        return Storage::url('uploads/blogs/' . $this->poster);
        
    }// end of getPosterPathAttribute


    
    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {

            return $q->where('title', 'like', '%' . $search . '%');

        });

    }// end of scopeWhenSearch

}
