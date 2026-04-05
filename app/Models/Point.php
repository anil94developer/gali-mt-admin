<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use MongoDB\BSON\UTCDateTime;

class Point extends Eloquent
{
    use HasFactory;
    use HybridRelations;

    protected $connection = 'mongodb';

    protected $collection = 'point_table';

    protected $fillable = [
        'game_type',
        'app_id',
        'admin_key',
        'user_id',
        'transaction_id',
        'uniquid',
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
        'win_bet_amt_not_use',
        'batId',
        'created_at',
        'updated_at'
    ];

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

        if (!$value instanceof DateTimeInterface) {
            $value = parent::asDateTime($value);
        }

        return new UTCDateTime((int) Date::parse($value)->valueOf());
    }

   
    public function user_data()
    {
        return $this->belongsTo(User::class, 'user_id', '_id'); 
    }

    /**
     * Relationship with Type model
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'tr_nature', 'tr_type_code');
    }
}
