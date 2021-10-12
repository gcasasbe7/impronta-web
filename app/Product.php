<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = ['name','likes','type','isExhausted','description','photo','price', 'price_s',
        'price_m','price_l','price_b','user_id','isPublic'];

    public $timestamps = false;

    public function orders(){
        return $this->belongsToMany('App\Order');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function ingredients(){
        return $this->belongsToMany('App\Ingredient');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function likes(){
        return $this->belongsToMany('App\User');
    }

    public function type(){
        return $this->hasOne('App\ProductType');
    }

    public function incLikes(){
        $this->likes++;
    }
    public function decLikes(){
        $this->likes--;
    }

    public function getIngredientsId(){
        $ingredients_id = DB::table('ingredient_product')
            ->select('ingredient_id')
            ->where('product_id',$this->id)
            ->get();

        return $ingredients_id;
    }
}
