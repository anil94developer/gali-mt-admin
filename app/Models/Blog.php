<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Blog extends Authenticatable
{
    protected $fillable = [
        'name',
        'title',
        'categoryName',
        'image',
        'status',
    ];
    protected $table="blogs";
}
