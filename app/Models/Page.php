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

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parentUp():BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
