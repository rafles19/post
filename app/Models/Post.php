<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'image',
        'slug',
        'lead',
        'author',
        'keywords',
        'thumbnail_image',
        'published_date',
        'user_id',
        'impression'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function slug()
    {
        return $this->hasOne(Slug::class);
    }

    public function desc()
    {
        return $this->hasOne(Description::class);
    }

    public function title()
    {
        return $this->hasOne(Title::class);
    }

    public function impression()
    {
        return $this->hasMany(Impression::class);
    }
    

    
}