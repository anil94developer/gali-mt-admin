<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Gallery extends Authenticatable
{
    protected $fillable = [
        'image',
        'is_home',
        'status',
    ];
    protected $table="galleries";
}
