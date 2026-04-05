<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Servicescategory extends Authenticatable
{
    protected $fillable = [
        'title',
        'serivecContent',
        'metaTitle',
        'descriptionmeta',
        'metaKeyword',
        'Status',
    ];
    protected $table="servicescatgorie";

    // function category_data(){
    //     return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    // }

}
