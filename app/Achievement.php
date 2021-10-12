<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = ['title','description', 'reward', 'photo'];
    public $timestamps = false;

    //All achievements belong to all users
    //We save in user_achivements the DONE achievements by the user
    //To obtain all users that has achieve achievement with id = 2:
    //SELECT user_id FROM user_achievements WHERE achievement_id = 2;

    public function users(){
        return $this->belongsToMany('App\User');
    }
    /**
    public function users(){
        return $this->hasMany('App\User');
    }**/
}
