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



class Walletreport extends Eloquent
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
        'game_type',
        'app_id',
        'user_id',
        'tr_nature',
        'win_value',
        'tr_value',
        'type',
        'tr_value_updated',
        'value_update_by',
        'date',
        'date_time',
        'tr_status',
        'tr_remark',
        'table_id',
        'transaction_id',
        'order_id',
        'upi_id',
        'is_win',
        'is_transfer',
        'transfer_user_id',
        'point_table_id',
        'pred_num',
        'is_deleted',
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

    protected $collection = 'wallet_reports';
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
        return $this->belongsTo('App\Modles\Supers','role_id');
    }
}
