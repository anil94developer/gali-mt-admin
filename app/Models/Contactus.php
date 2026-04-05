<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contactus extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
    ];
    protected $table="contactus";

}
