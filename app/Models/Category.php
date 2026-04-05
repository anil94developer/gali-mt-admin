<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'is_deleted',
        'status',
    ];
    protected $table="categories";

    public function sub_category(){
        return $this->hasMany('App\Models\SubCategory', 'category_id', 'id');
    }
}
