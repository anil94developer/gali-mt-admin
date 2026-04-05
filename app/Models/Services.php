<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Services extends Authenticatable
{
    protected $fillable = [
        'servicecat',
        'title',
        'image',
       'shortContent',
        'banner',
        'fullContent',
        'status',
    ];
    protected $table="services";

    // public function sub_category(){
    //     return $this->hasMany('App\Models\SubCategory', 'category_id', 'id');
    // }
}
