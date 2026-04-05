<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubAdminAttribute  extends Authenticatable
{
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'simple_pass',
        'password',
        'access_permission',
        'main_name',
        'seconday_name',
        'status',
        'is_deleted',
    ];
    protected $table="subadminattributes";

}
