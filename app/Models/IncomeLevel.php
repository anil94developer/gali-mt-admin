<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class IncomeLevel extends Authenticatable
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
    protected $table="level_incomes";


}
