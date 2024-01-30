<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'label_1', 
        'label_2', 
        'label_3', 
        'label_4', 
        'description_1', 
        'description_2', 
        'description_3', 
        'description_4', 
        'image_1', 
        'image_2', 
        'image_3', 
        'image_4',
        'type'
    ];
}
