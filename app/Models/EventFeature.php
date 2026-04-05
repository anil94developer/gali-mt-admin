<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EventFeature extends Authenticatable
{
    protected $fillable = [
        'event_id',
        'title',
        'price',
        'status'
    ];
    protected $table="eventfeatures";

}
