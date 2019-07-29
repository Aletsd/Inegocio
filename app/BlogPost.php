<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table = 'blog_posts';

    protected $fillable = [
        'category_id','title', 'introduction', 'description', 'avatar', 'user_id', 'status', 'topic'
    ];

    protected $visible = [
        'category_id','title', 'introduction', 'description', 'avatar', 'user_id', 'status', 'topic'
    ];
  
    public function category(){
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
