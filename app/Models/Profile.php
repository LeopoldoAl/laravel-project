<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // In order to prevent these field are assigned in mass way
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relationship one to one inverse (profile-user)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
