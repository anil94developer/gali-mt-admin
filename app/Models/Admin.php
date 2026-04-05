<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Date;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use MongoDB\BSON\UTCDateTime;

class Admin extends Eloquent implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use Authenticatable, HybridRelations;

    protected $connection = 'mongodb';
    protected $fillable = [
        'username',
        'email',
        'simple_pass',
        'password',
        'role',
        'ad_name',
        'mobile',
        'otp',
        'id',
        'role_id',
        'ad_email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $table = 'admin_config';
    public static function setCollection($collection)
    {
        $instance = new self();
        $instance->collection = $collection;
        return $instance;
    }

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