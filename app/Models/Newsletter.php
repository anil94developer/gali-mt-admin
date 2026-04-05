<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Newsletter extends Authenticatable
{
    protected $fillable = [
        'email',
        'status',
    ];
    protected $table="newsletters";
}
