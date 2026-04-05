<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Tabletype extends Eloquent
{
    use HasFactory;
    use HybridRelations;

    protected $connection = 'mongodb';

    protected $collection = 'tbl_types';
    protected $fillable = [
        'tbl_name',
        'tbl_txt',
        'min_point',
        'tbl_code',
        'tbl_image',
        'price_lot',
        'commision',
        'lot_time',
        'time_interval',
        'start_time',
        'end_time',
        'min_point_play',
        'max_point_allowed',
    ];
}
