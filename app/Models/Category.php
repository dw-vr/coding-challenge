<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //Table name in DDBB
    protected $table='category';

    //if no primary key is specified, then a default one named id is created.

    //fillable fields are those that can be asigned
    protected $fillable= array('name');

    //hidden fields are not returned in a query
    protected $hidden = ['created_at','updated_at'];

    //Each category have many products
    public function products(){
      return $this->hasMany('App\Product');
    }
}
