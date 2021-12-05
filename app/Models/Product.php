<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //Table name in DDBB
    protected $table='products';

    //if no primary key is specified, then a default one named id is created.
    protected $primaryKey= 'sku';

    //fillable fields are those that can be asigned
    protected $fillable= array('name','category','sku','price','quantity');

    //hidden fields are not returned in a query
    protected $hidden = ['created_at','modified_at'];

    //Each product has 1:N relationship with a category
    public function category(){
      return $this->belongsTo('App\Category');
    }
}
