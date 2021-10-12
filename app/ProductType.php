<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = ['typename'];
    public $timestamps = false;

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
