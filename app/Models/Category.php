<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Category extends Model
{

    use HasFactory;    

    protected $fillable = [
        'title',
        'color',
        'meta_data',
    ];

    //One category has many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected $casts = [
        'meta_data' => 'array', // Assuming meta_data is stored as a JSON object
    ];
}
