<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Date;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\UTCDateTime;

class Super extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb'; // Use MongoDB connection

    protected $collection = 'supers'; // Define collection name

    protected $fillable = [
        'userid', 'mobile', 'email', 'password', 'role_id', 'ad_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * MongoDB driver rejects UTCDateTime($date->format('Uv')) when format returns string.
     */
    public function freshTimestamp()
    {
        return new UTCDateTime((int) round(microtime(true) * 1000));
    }

    /**
     * @param  mixed  $value
     */
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
}
