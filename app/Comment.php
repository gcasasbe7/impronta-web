<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['id','user_id','product_id','comment','user_name','user_photo'];
    public $timestamps = false;

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
