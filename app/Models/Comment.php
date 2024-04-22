<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    // In order to prevent these field are assigned in mass way
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relationship one to many inverse (comments-user)
    public function user(){
        return $this->belongsTo(User::class);
     }
    // Relationship one to many inverse (comments-article)
    public function article(){
        return $this->belongsTo(Article::class);
     }
}
