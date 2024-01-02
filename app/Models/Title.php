<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $fillable = ['title_name', 'post_id'];
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}