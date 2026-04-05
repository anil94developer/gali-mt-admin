<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserCoin extends Authenticatable
{
    protected $fillable = [
        'money',
        'transStatus',
        'upiId',
        'TranID',
        
    ];
    protected $table="usercoin";

    // function user_data(){
    //     return $this->belongsTo('App\Models\User', 'user_id', 'id');
    // }

}
