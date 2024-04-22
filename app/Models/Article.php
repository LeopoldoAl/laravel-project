<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    
    // In order to prevent these field are assigned in mass way
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relationship one to many invers (article-user)
    // here we place user in singular form, because are many to one
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Relationship one to many (article-comments)
    public function comments(){
        return $this->hasMany(Comment::class);
     }
     // Relationship one to many inverse (category-article)
    public function category(){
        return $this->belongsTo(Category::class);
     }
     // To use slug instead of id
     public function getRouteKeyName(){
        return 'slug';
     }
}
