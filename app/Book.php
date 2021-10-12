<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['user_id','numPeople', 'bookDate','state'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
