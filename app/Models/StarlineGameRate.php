<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StarlineGameRate extends Authenticatable
{
    protected $fillable = [
        'single_digit_value1',
        'single_digit_value2',
        'jodi_digit_value1',
        'jodi_digit_value2',
        'single_pana_value1',
        'single_pana_value2',
        'double_pana_value1',
        'double_pana_value2',
        'triple_pana_value1',
        'triple_pana_value2',
        'Half_Sangam_Value1',
        'Half_Sangam_Value2',
        'full_Sangam_Value1',
        'full_Sangam_Value2',
    ];
    protected $table="starline_game_rate_list";
}
