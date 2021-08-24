<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $primaryKey = "id";
    protected $fillable = ['content' , 'parent_id' , 'user_id'];
    public  function  getParentId()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function info() {
        return $this->belongsTo(User::class , 'user_id');
    }
    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

}
