<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RequestCallback extends Authenticatable
{
    protected $fillable = [
        'username',
        'email',
        'mobile',
        'city',
        'pincode',
        'message',
        'status',
    ];
    protected $table="requestcallbacks";
}
