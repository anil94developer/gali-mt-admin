<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Feedback extends Authenticatable
{
    protected $fillable = [
        'user_id',
        'event_id',
        'image',
        'event_title',
        'status',
        'name',
        'city_name',
        'message',
    ];
    protected $table="feedbacks";
}
