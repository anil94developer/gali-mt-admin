<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GeneralSetting extends Authenticatable
{
    protected $fillable = [
        'site_name',
        'site_logo',
        'mobileno',
        'mobileno2',
        'email',
        'email2',
        'address',
        'timing',
        'copyright',
        'facebook_link',
        'youtube_link',
        'instagram_link',
        'linkedin_link',
        'twitter_link',
        'event_detail_image',
    ];
    protected $table="general_settings";

}
