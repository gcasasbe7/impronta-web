<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title','description', 'photo', 'start_date','end_date'];
    public $timestamps = false;

    //
}
