<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'category_id',
        'group_id',
        'adType',
        'price',
        'currency',
        'description',
        'created_at',
        'updated_at',
        'image_path',
    ];
}
