<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'parent_id', 'slug'];

    public function parent_id() {
        return $this->hasOne(Page::class, 'id', 'parent_id')->first();
    }
}
