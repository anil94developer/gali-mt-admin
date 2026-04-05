<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Concerns\MongoDbDateTimeFix;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class PaymentGetway extends Eloquent
{
    // use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    use HybridRelations;
    use MongoDbDateTimeFix;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */

    protected $connection = 'mongodb';

    protected $collection = 'payment_getways';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
        /**
     * The attributes that should be cast.
     *
     * @var array
     */
   


}
