<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Type extends Authenticatable
{
    protected $fillable = [
        
        'tr_type_code',
        'tr_type_name',
    ];
    protected $table="tr_type";
}
