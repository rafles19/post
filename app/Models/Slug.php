<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'post_id'];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
