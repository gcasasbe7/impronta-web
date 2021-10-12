<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ingredient extends Model
{
    protected $fillable = ['name','price'];
    public $timestamps = false;

    public function products(){
        return $this->belongsToMany('App\Product');
    }

    public function getProductsWithMyIng(){
        $products = array();
        $products_id = DB::table('ingredient_product')
            ->select('product_id')
            ->where('ingredient_id','=',$this->id)
            ->get();

        $array = json_decode(json_encode($products_id), true);
        foreach ($array as $element){
            foreach ($element as $el){
                array_push($products,$el);
            }
        }
        return $products;
    }
}
