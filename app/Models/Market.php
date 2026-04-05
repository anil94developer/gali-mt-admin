<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Date;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use MongoDB\BSON\UTCDateTime;
class Market extends Eloquent
{
  use HasFactory;
  use HybridRelations;
  protected $fillable = [
    'market_name',
    'market_id',
    'market_view_time_open',
    'market_view_time_close',
    'market_sunday_time_close',
    'market_sunday_time_open',
    'is_holiday',
    'updated_time_date',
    'status',
    'is_time_limit_applied',
    'is_no_limit_game',
    'close_by_admin',
    'market_type',
    'market_sub_name',
    'market_sunday_off',
    'market_status',
    'app_id',
    'market_position',
    'agent_id',
    'market_position',
    'is_deleted',
  ];

  protected $connection = 'mongodb';

  protected $collection = 'comx_appmarkets';
  protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
  ];

  public function freshTimestamp()
  {
    return new UTCDateTime((int) Date::now()->format('Uv'));
  }

  public function fromDateTime($value)
  {
    if ($value instanceof UTCDateTime) {
      return $value;
    }

    if (!$value instanceof DateTimeInterface) {
      $value = parent::asDateTime($value);
    }

    return new UTCDateTime((int) $value->format('Uv'));
  }

  function resultdata()
  {
    return $this->hasMany('App\Models\Result', 'order_id', 'id');
  }
  function result()
  {
    return $this->belongsTo('App\Models\Result', 'market_id', 'market_id');
  }
}
