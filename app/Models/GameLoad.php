<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Concerns\MongoDbDateTimeFix;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
class GameLoad extends Eloquent
{
    // use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    use HybridRelations;
    use MongoDbDateTimeFix;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'transaction_id',
        'tr_nature',
        'game_type',
        'win_value',
        'tr_value',
        'is_win',
        'tr_value_updated',
        'value_update_by',
        'tr_value_type',
        'tr_device',
        'date',
        'tr_remark',
        'tr_status',
		'created_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $connection = 'mongodb';

    protected $collection = 'game_load';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    function user_data(){
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
	
	function t_userid(){
        return $this->belongsTo('App\Models\User', 'transfer_user_id', 'user_id');
    }

	function market_data(){
        return $this->belongsTo('App\Models\Market', 'table_id', 'market_id');
    }
 
  function type(){
        return $this->belongsTo('App\Models\Type', 'tr_nature', 'tr_type_code');
    }


}
