<?php
namespace App\Models;

use DateTimeInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Date;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use MongoDB\BSON\UTCDateTime;

class ManageCommission extends Eloquent
{
    use HasFactory;
    use HybridRelations;
    protected $fillable = [
        'user_id',
        'market_id',
        'bat_amount',
        'win_amount',
        'status',
        'date',
        'reciver_user_id',
        'visible',
    ];
    protected $connection = 'mongodb';

    protected $collection = 'manage_commissions';
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

    function user_data()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
    function reciver_user_data()
    {
        return $this->belongsTo('App\Models\User', 'reciver_user_id', 'user_id');
    }

}
