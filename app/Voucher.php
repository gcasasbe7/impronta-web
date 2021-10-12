<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = ['code','points','dead_date','is_used','user_id'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\User');
    }

}
