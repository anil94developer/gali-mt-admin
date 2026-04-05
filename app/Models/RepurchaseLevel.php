<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RepurchaseLevel extends Authenticatable
{
    protected $fillable = [
        'id',
        'level',
        'amount',
        'day',
        'direct',
        'total_leg',
        'status',
        'is_deleted',
    ];
    protected $table="repurchases";


}
