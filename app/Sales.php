<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
 protected $fillable = [

    'product_quantity',
    'product_cost',
    'product_id',
    'unitTotal',
    'total_cost',
    'product',
    'discount',
    'unitNet',
 ];
 public function productname()
 {
     return $this->hasOne('App\Product' , 'id' , 'product_id');
 }
}
