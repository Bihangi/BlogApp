<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    
    use HasFactory;
    protected $fillable = [
        'comment',
        'meta_data',
        'post_id',
        'author_id',
    ];

    //One comment is written by an author(user)
    public function author()
    {  
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    //One comment is on a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
