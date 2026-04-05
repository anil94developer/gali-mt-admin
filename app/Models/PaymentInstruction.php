<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
class PaymentInstruction extends Eloquent
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'note',
        'status',
        'file'

    ];
    protected $connection = 'mongodb';

    protected $collection = 'payment_instruction';
}
