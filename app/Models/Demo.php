<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Demo extends Authenticatable
{
    protected $fillable = [
        'fristname',
        'listname',
        'email',
        'moblieno',
        'gender',
        'userType',
        'address',
        'tremCondition',
        'status',
    ];
    protected $table="demo";

    // function e_image(){
    //     return $this->hasMany('App\Models\EventImage', 'event_id', 'id');
    // }

    // function e_feature(){
    //     return $this->hasMany('App\Models\EventFeature', 'event_id', 'id');
    // }

}
