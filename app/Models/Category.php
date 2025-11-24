<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable = [
        'slug',
        'description',
        'image',
        'created_by'
    ];

    function creator(){
        return $this->belongsTo(User::class , 'created_by');
    }
    function products(){
        return $this->hasMany(Product::class);
    }
}
