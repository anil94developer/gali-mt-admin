<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EventImage extends Authenticatable
{
    protected $fillable = [
        'event_id',
        'image',
        'status',
    ];
    protected $table="eventimages";
}
