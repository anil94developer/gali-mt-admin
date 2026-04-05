<?php

namespace App\Models\Concerns;

use DateTimeInterface;
use Illuminate\Support\Facades\Date;
use MongoDB\BSON\UTCDateTime;

/**
 * jenssegers/mongodb base Model uses new UTCDateTime($value->format('Uv')) — format() returns a string;
 * ext-mongodb throws InvalidArgumentException: Expected integer or object, string given.
 */
trait MongoDbDateTimeFix
{
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
}
