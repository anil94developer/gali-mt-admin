<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SupportSystem extends Authenticatable
{

    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'reply',
        'status',
        'is_deleted	',
    ];
    protected $table="support_systems";

    public function get_username(){
        return $this->belongsTo('App\Models\User', 'userId');
    }

}
