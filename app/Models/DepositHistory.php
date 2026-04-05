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


class DepositHistory extends Eloquent
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
        'game_type',
        'app_id',
        'admin_key',
        'user_id',
        'transaction_id',
        'tr_nature',
        'slot_id',
        'win_value',
        'tr_value',
        'status',
        'tr_value_updated',
        'value_update_by',
        'tr_value_type',
        'tr_device',
        'date',
        'date_time',
        'tr_remark',
        'tr_status',
        'table_id',
        'is_win',
        'is_result_declared',
        'pred_num',
        'close_sangam',
        'is_deleted',
        'device_type',
        'device_id',
        'created_at',
        'updated_at',
        'win_bet_amt_not_use',
        'image',
        'username',
        'mobile_number'
        
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

    protected $collection = 'deposit_history';
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

    function user_data(){
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

}
