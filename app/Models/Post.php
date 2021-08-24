<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = "posts";
    protected $primaryKey = "id";
    protected $fillable = ['title' , 'content' , 'slug'];
    public  function getInfoUser(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public  function  comments() {
        return $this->hasMany(Comment::class , 'post_id');
    }

    public  function getTitleAttribute($value){
        return ucfirst($value);
    }
    public function setContentAttribute($vale){
        return $this->attributes['content'] = ucfirst($vale);
    }
    public function userId(){
        return $this->belongsTo(User::class , 'user_id');
    }
    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];
}
