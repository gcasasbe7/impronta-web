<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $start = microtime(true);

        $products = Product::all();

        $end = microtime(true);

        info("GETTING HK MODELS:" . ($end - $start));
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'isExhausted' => 'required',
            'description' => 'required',
        ]);

        Product::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'isExhausted' => 'required',
            'description' => 'required',
        ]);

        $product = Product::find($id);
        $product->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function getIngredients($id){
        $product = Product::find($id);
        return $product->ingredients()->get();
    }

    public function deleteIngredientFromProduct($ingredient_id,$product_id){
        DB::table('ingredient_product')
            ->where('product_id',$product_id)
            ->where('ingredient_id',$ingredient_id)
            ->delete();
    }

    public function addIngredientToProduct($ingredient_name,$product_id){
        $ingredient_id = $this->getIngredientIdByName($ingredient_name);
        $values = array('product_id' => $product_id, 'ingredient_id' => $ingredient_id);
        DB::table('ingredient_product')->insert($values);
    }

//    public function getProductsByType(){
//        $products = Product::with('comments','ingredients')->get();
//        $pizzas = Product::where('type',1)->with('comments','ingredients')->get();
//        $antipasto = Product::where('type',2)->with('comments','ingredients')->get();
//        $ensaladas = Product::where('type',3)->with('comments','ingredients')->get();
//        $bebidas = Product::where('type',4)->with('comments','ingredients')->get();
//        $helados = Product::where('type',5)->with('comments','ingredients')->get();
//
//
//        if (Auth::check()){
//            $user = Auth::user();
//            $likes = $user->getLikes();
//            $dontlikesIngredients = $user->getDontLikesIngredients();
//            $dontlikesProducts = $user->getDontLikesProducts();
//
//            $data = array(
//                "products" => $products,
//                "pizzas" => $pizzas,
//                "antipasto" => $antipasto,
//                "ensaladas" => $ensaladas,
//                "bebidas" => $bebidas,
//                "helados" => $helados,
//                "likes" => $likes,
//                "dontlikes" => $dontlikesIngredients,
//                "dontlikesproducts" => $dontlikesProducts,
//                "user_id" => $user->id
//            );
//
//        }else{
//            $data = array(
//                "products" => $products,
//                "pizzas" => $pizzas,
//                "antipasto" => $antipasto,
//                "ensaladas" => $ensaladas,
//                "bebidas" => $bebidas,
//                "helados" => $helados,
//            );
//        }
//        $response = response()->json($data,200);
//        return $response;
//    }

    public function getProductsByType(){
        $start = microtime(true);

        $products = Product::where('user_id',1)->with('comments','ingredients')->get();
        $pizzas = Product::where('type',1)->where('user_id',1)->with('comments','ingredients')->get();
        $antipasto = Product::where('type',2)->where('user_id',1)->with('comments','ingredients')->get();
        $ensaladas = Product::where('type',3)->where('user_id',1)->with('comments','ingredients')->get();
        $bebidas = Product::where('type',4)->where('user_id',1)->with('comments','ingredients')->get();
        $helados = Product::where('type',5)->where('user_id',1)->with('comments','ingredients')->get();
        $community = Product::where('user_id','!=',1)->where('isPublic',1)->with('comments','ingredients','user')->get();


        if(Auth::check()){
            $userpizzas = Product::where('user_id',Auth::user()->id)->with('comments','ingredients','user')->get();

            $user = Auth::user();

            $likes = $user->getLikes();

            $authLikedProducts = $this->getUserLikedProducts();

            $dontlikesIngredients = $user->getDontLikesIngredients();
            $dontlikesProducts = $user->getDontLikesProducts();

            $data = array(
                "products" => $products,
                "pizzas" => $pizzas,
                "antipasto" => $antipasto,
                "ensaladas" => $ensaladas,
                "bebidas" => $bebidas,
                "helados" => $helados,
                "community" => $community,
                "likes" => $likes,
                "dontlikes" => $dontlikesIngredients,
                "dontlikesproducts" => $dontlikesProducts,
                "user_id" => $user->id,
                "userpizzas" => $userpizzas,
                "userfavs" => $authLikedProducts,
                "userdirection" => $user->direction
            );
        }else{
            $data = array(
                "products" => $products,
                "pizzas" => $pizzas,
                "antipasto" => $antipasto,
                "ensaladas" => $ensaladas,
                "bebidas" => $bebidas,
                "helados" => $helados,
            );
        }


        $end = microtime(true);

        info("GETTING MENU DATA:" . ($end - $start));

        $response = response()->json($data,200);
        return $response;
    }

    public function getUserLikedProducts(){
        $user = Auth::user();

        $profileLikedProducts = Product::whereHas('likes', function($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->get();

        $authLikedProducts = Product::whereHas('likes', function($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->whereIn('id', $profileLikedProducts->pluck('id'))->with('ingredients','comments','user')->get();

        return $authLikedProducts;
    }


    public function deleteLike(Request $request){
        $product_id = $request->input('product_id');
        $user_id = Auth::user()->id;

        DB::table('product_user')
            ->where('product_id',$product_id)
            ->where('user_id',$user_id)
            ->delete();

        $product = Product::find($product_id);
        $product->decLikes();
        $product->save();

        return "OK";
    }

    public function addLike(Request $request){
        $product_id = $request->input('product_id');
        $user_id = Auth::user()->id;

        DB::table('product_user')->insert(
            ['user_id' => $user_id, 'product_id' => $product_id]
        );

        $product = Product::find($product_id);
        $product->incLikes();
        $product->save();

        return "OK";
    }

    public function getUserPizzas(){
        $pizzas = Product::where('user_id',Auth::user()->id)->with('ingredients')->get();

        $data = array(
            'userpizzas' => $pizzas
        );
        $response = response()->json($data,200);
        return $response;
    }

    public function getIngredientsName(){
        $ingredients = Ingredient::all();
        $data = array(
            'ingredients' => $ingredients
        );
        $response = response()->json($data,200);
        return $response;
    }

    public function getProductsName(){
        $ingredients = Product::all();
        $data = array(
            'ingredients' => $ingredients
        );
        $response = response()->json($data,200);
        return $response;
    }

    public function createMyPizza(Request $request){
        $request->request->add(['user_id' => Auth::user()->id]);
        $request->request->add(['photo' => Auth::user()->photo]);
        $request->request->add(['type' => 1]);

        $product = Product::create($request->all());


        $ingredients_names = $request->input('ingredients');
        foreach ($ingredients_names as $ingredient){
            $values = array('product_id' => $product->id, 'ingredient_id' => $this->getIngredientIdByName($ingredient));
            DB::table('ingredient_product')->insert($values);
        }

        return "OK";

    }
    public function getIngredientIdByName($ingredient_name){
        $ingredient_id = Ingredient::where('name',$ingredient_name)->first()->id;
        return $ingredient_id;
    }

    public function deleteMyPizza($pizza_id){
        $product = Product::findOrFail($pizza_id);
        $product->delete();
    }

    public function getUserFavs(){
        $user = Auth::user();
        $authLikedProducts = $this->getUserLikedProducts();

        $data = array(
            'favs' => $authLikedProducts,
            'points' => $user->points
        );
        $response = response()->json($data,200);
        return $response;
    }

    public function getLocalRecommendations(){
        $localPizzas = array();

        $michelangello = Product::find(2);
        $tiziano = Product::find(3);
        $rafaello = Product::find(4);

        array_push($localPizzas,$michelangello);
        array_push($localPizzas,$tiziano);
        array_push($localPizzas,$rafaello);

        $data = array(
            'local' => $localPizzas
        );
        $response = response()->json($data,200);
        return $response;
    }

    public function getUserRecommendations(Request $request){
        $start = microtime(true);

        $productsToRecommend = array();
        $products = $request->input("orderproducts");
        $recoFile = Storage::get('recommender.json');
        if(strlen($recoFile) != 0){
            $recoFileJson = json_decode($recoFile,true);

            foreach($products as $object){
                $id = $object['product']['id'];

                foreach($recoFileJson as $couple){
                    if($couple['product_id_0'] == $id && $this->notInOrder($couple['product_id_1'],$products) && $this->notInRecommend($couple['product_id_1'],$productsToRecommend)){
                        info("pushing " . $couple['product_id_1']);
                        array_push($productsToRecommend,Product::find($couple['product_id_1']));
                    }else if($couple['product_id_1'] == $id && $this->notInOrder($couple['product_id_0'],$products) && $this->notInRecommend($couple['product_id_0'],$productsToRecommend)){
                        info("pushing else" . $couple['product_id_0']);
                        array_push($productsToRecommend,Product::find($couple['product_id_0']));
                    }
                }
            }
            $productsToRecommend = $this->checkRecommendationsIngredients($productsToRecommend);
        }


        $data = array(
            'user' => $productsToRecommend
        );
        $response = response()->json($data,200);
        $end = microtime(true);

        info("GETTING RECOMMENDATION TIME:" . ($end - $start));
        return $response;
    }

    public function notInOrder($id,$products){
        $result = true;
        foreach($products as $object){
            if($object['product']['id'] == $id){
                $result = false;
            }
        }
        return $result;
    }

    public function notInRecommend($id,$products){
        $result = true;
        foreach($products as $product){
            if($product['id'] == $id){
                $result = false;
            }
        }
        return $result;
    }

    public function checkRecommendationsIngredients($productsToRecommend){
        $dontlikeingredients = Auth::user()->getDontLikesIngredients();

        foreach($productsToRecommend as $key=>$product){
            $productIngredients = $product->getIngredientsId();
            foreach ($productIngredients as $ing){
                foreach ($dontlikeingredients as $dontlikeing){
                    if($ing->ingredient_id == $dontlikeing->ingredient_id){
                        unset($productsToRecommend[$key]);
                    }
                }
            }
        }

        return $productsToRecommend;
    }

}
