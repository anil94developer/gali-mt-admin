<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OrderMeta extends Authenticatable
{
    protected $fillable = [
        'order_id',
        'qty',
        'unitPrice',
        'name',
        'status',
    ];
    protected $table="order_metas";


}
