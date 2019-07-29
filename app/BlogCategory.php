<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $table = 'blog_categories';

    protected $dates = ['deleted_at'];

    protected $fillable = ['title'];

    protected $visible = ['title'];
}
