<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Asseenno extends Authenticatable
{
    protected $fillable = [
        'image',
        'is_home',
        'status',
    ];
    protected $table="asseenno";
}
