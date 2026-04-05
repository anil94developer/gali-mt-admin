<?php
namespace App\Models;
use DateTimeInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Date;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use MongoDB\BSON\UTCDateTime;

class Result extends Eloquent
{
  use HasFactory;
  use HybridRelations;
    protected $fillable = [
      'market_id',
      'result',
      'date',
      'date_time_result',
    ];
    protected $connection = 'mongodb';

    protected $collection = 'results_tbls';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * PECL mongodb 2.x: UTCDateTime expects int ms, not a string. jenssegers passes format('Uv') as string.
     */
    public function freshTimestamp()
    {
        return new UTCDateTime((int) Date::now()->format('Uv'));
    }

    public function fromDateTime($value)
    {
        if ($value instanceof UTCDateTime) {
            return $value;
        }

        if (! $value instanceof DateTimeInterface) {
            $value = parent::asDateTime($value);
        }

        return new UTCDateTime((int) $value->format('Uv'));
    }

	function market(){
        return $this->belongsTo('App\Models\Market', 'market_id', 'market_id');
    }

    function point_type(){
      return $this->belongsTo('App\Models\Point', 'id','id');
  }
}
