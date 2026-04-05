<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CMS extends Authenticatable
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'status',
    ];
    protected $table="cms";
}
