<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Date;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\BSON\UTCDateTime;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class User extends Eloquent
{
    // use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    use HybridRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'app_id',
        'FullName',
        'mob',
        'us_pass',
        'us_gender',
        'dob',
        'credit',
        'image',
        'bonus_diamonds',
        'ref_code',
        'is_ref_enabled',
        'ref_by',
        'ref_bonous',
        'lat',
        'lng',
        'address',
        'dev_model',
        'dev_name',
        'device_id',
        'user_status',
        'reg_date',
        'last_login',
        'last_active',
        'banned',
        'date',
        'date_time',
        'created_at',
        'updated_at',
        'prev_pass',
        'is_child',
        'is_ref_check',
        'win_amount',
        'last_seen',
        'is_playstore',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $connection = 'mongodb';

    protected $collection = 'us_reg_tbl';
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function freshTimestamp()
    {
        return new UTCDateTime((int) round(microtime(true) * 1000));
    }

    public function fromDateTime($value)
    {
        if ($value instanceof UTCDateTime) {
            return $value;
        }

        if (! $value instanceof DateTimeInterface) {
            $value = parent::asDateTime($value);
        }

        return new UTCDateTime((int) Date::parse($value)->valueOf());
    }

    public function Job()
    {
        return $this->belongsTo('App\Modles\Supers', 'role_id');
    }
}
