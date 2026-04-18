<?php

namespace App\Models;

use App\Models\Concerns\MongoDbDateTimeFix;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AppControllerSetting extends Eloquent
{
    use HasFactory;
    use HybridRelations;
    use MongoDbDateTimeFix;

    protected $connection = 'mongodb';
    protected $collection = 'app_controller';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

