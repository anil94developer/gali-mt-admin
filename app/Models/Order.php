<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Order extends Authenticatable
{
    protected $fillable = [
        'id',
        'user_id',
        'total_amount',
        'payment_status',
        'current_status',
        'status',
        'is_deleted',
    ];
    protected $table="orders";

    function order_meta(){
        return $this->hasMany('App\Models\OrderMeta', 'order_id', 'id');
    }
    public function user_detail(){
        return $this->belongsTo("App\Models\User", 'user_id');
    }

    function event_data(){
        return $this->belongsTo('App\Models\Event', 'event_id', 'id');
    }
}
