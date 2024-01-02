<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $fillable = ['desc_name', 'post_id'];
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}