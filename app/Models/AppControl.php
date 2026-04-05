<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Concerns\MongoDbDateTimeFix;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class AdminControl extends Eloquent
{

    use HasFactory;
    use HybridRelations;
    use MongoDbDateTimeFix;
    protected $fillable = [
        'id',
        'ad_email',
        'ad_name',
        'ad_whtsp',
        'ad_package_key',
        'app_updated_version',
        'force_update',
        'is_app_maintanace',
        'till_date_maintanace',
        'maintanace_message',
        'maintanace_title',
        'maintanace_image',
        'online_deposit',
        'whatsapp_deposit',
        'currency',
        'wallet',
        'history',
        'transaction',
        'redeem',
        'rates',
        'accesskey',
        'commission',
        'upiid',
        'updated_at',
    ];
    protected $connection = 'mongodb';

    protected $collection = 'admin_config';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
