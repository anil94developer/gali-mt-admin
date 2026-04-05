<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MongoDbDateTimeFix;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Notice extends Eloquent
{
    use HasFactory;
    use HybridRelations;
    use MongoDbDateTimeFix;
    protected $fillable = [
        'id',
        'description',
    ];
    protected $connection = 'mongodb';

    protected $collection = 'notices';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
