<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Date;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use MongoDB\BSON\UTCDateTime;

class Faq extends Eloquent
{
    use HasFactory;
    use HybridRelations;
    protected $fillable = [
        'id',
        'title',
        'description',
        'section_id'
    ];
    protected $connection = 'mongodb';

    protected $collection = 'faqs';
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
	

    function question()
    {
        return $this->hasMany('App\Question', 'faq_id');
    }
}
