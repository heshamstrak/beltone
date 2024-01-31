<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id', 'url'];


    public function parent_id() {
        return $this->hasOne(self::class, 'id', 'parent_id')->first();
    }// end parent_id

    //Children Relation
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }// end children
}
