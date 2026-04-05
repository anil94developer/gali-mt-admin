<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BlogCategory extends Authenticatable
{
    protected $fillable = [
        'title',
        'image',
        'slug',
        'status',
    ];
    protected $table="blog_categories";
}
