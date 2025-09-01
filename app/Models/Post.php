<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Post extends Model
{

    use HasFactory;

    protected $fillable = [
        'tilte',
        'content',
        'post_type',
        'meta_data',
        'category_id',
        'author_id',
    ];


    //A post is written by an author(user)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    //A post belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //A post might have many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //A post might have many tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
