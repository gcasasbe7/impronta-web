<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'surnames','email', 'password', 'isAdmin','points', 'direction', 'phone','photo','recievePromotions'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function points(){
        return $this->points;
    }

    public function isAdmin() {
        return $this->isAdmin;
    }
    public function name(){
        return $this->name;
    }

    /**
     * Relation to get user books
     * One user can have n books
     */
    public function books(){
        return $this->hasMany('App\Book');
    }


    /**
     * Relation to get user liked products
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes(){
        return $this->belongsToMany('App\Product');
    }

    /**
     * Relation to get user achievements
     * One user has n achievements (Some of them done, others not)
     */
    public function achievements(){
        return $this->belongsToMany('App\Achievement');
    }

    /**
     * Relation to get user orders
     * One user can have n orders
     */
    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function voucher(){
        return $this->hasOne('App\Voucher');
    }

    public static function boot(){
        parent::boot();

        static::creating(function($user) {
            $user->token = str_random(40);
        });
    }

    public function hasVerified(){
        $this->verified = true;
        $this->token = null;

        $this->save();

    }

    public function getLikes(){
        $products_id = DB::table('product_user')
            ->select('product_id')
            ->where('user_id',$this->id)
            ->get();

        return $products_id;
    }

    public function getLikesProducts(){
        $products = array();
        $products_id = DB::table('product_user')
            ->select('product_id')
            ->where('user_id',$this->id)
            ->get();


        foreach ($products_id as $id){
            array_push($products, Product::find($id->product_id)->with('ingredients')->get());
        }

        return $products;
    }

    public function getDontLikesProducts(){
        $danger_products = array();
        $temp = array();
        $ingredients_id = DB::table('user_dontlike')
            ->select('ingredient_id')
            ->where('user_id',$this->id)
            ->get();

        foreach($ingredients_id as $id){
            $ingredient = Ingredient::find($id->ingredient_id);
            if($ingredient != null){
                array_push($danger_products, $ingredient->getProductsWithMyIng());
            }
        }

        foreach($danger_products as $danger){
            foreach($danger as $el){
                array_push($temp, $el);
            }
        }

        return $temp;
    }

    public function getDontLikesIngredients(){
        $ingredients_id = DB::table('user_dontlike')
            ->select('ingredient_id')
            ->where('user_id',$this->id)
            ->get();

        return $ingredients_id;
    }



}
