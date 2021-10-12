<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','orderDate', 'state','total_price','reward_points', 'direction','is_payed'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function orderproducts(){
        return $this->hasMany('App\OrderProduct');
    }

    public function products(){
        return $this->belongsToMany('App\Product');
    }

}
