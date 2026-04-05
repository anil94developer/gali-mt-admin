<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ReviewRating extends Authenticatable
{
    protected $fillable = [
        'user_id',
        'event_id',
        'name',
        'email',
        'rating',
        'message',
        'status',
        'event_title',
    ];
    protected $table="review_ratings";
}
