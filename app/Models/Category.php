<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // In order to prevent these field are assigned in mass way
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relationship one to many (article-category)
    public function articles(){
        return $this->hasMany(Article::class);
     }
     // We go to use slug by the id
     public function getRouteKeyName(){
        return 'slug';
     }
}
