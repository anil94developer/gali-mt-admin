<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MongoDbDateTimeFix;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class AppNotice extends Eloquent
{
    use HasFactory;
    use HybridRelations;
    use MongoDbDateTimeFix;

    protected $fillable = [
        'id',
        'title',
        'description',
        'is_display',
    ];
    protected $connection = 'mongodb';

    protected $collection = 'app_notices';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
