<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubCategory extends Authenticatable
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'category_name',
        'image',
        'price',
        'description',
        'status',
        'is_deleted',
    ];
    protected $table="subCategories";

    function category_data(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

}
