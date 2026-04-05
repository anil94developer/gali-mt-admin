<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class BonusReport extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
	 
     */
    protected $fillable = [
        'transaction_id',
        'user_id',
        'date',
        'payer_id',
        'amount',
		'date',
                
    ];

 protected $table="referal_income_report";
    
    function user_data(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
	
	function payer_data(){
        return $this->belongsTo('App\Models\User', 'payer_id', 'id');
    }

}
