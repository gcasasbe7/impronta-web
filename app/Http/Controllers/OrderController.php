<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->get();
        return $orders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user_id' => 'required',
            'orderDate' => 'required',
            'state' => 'required',
            'direction' => 'required',
        ]);

        Order::create($request->all());

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return $order;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'user_id' => 'required',
            'orderDate' => 'required',
            'state' => 'required',
            'direction' => 'required',
        ]);

        Order::find($id)->update($request->all());

        return;
    }

    public function updateState(Request $request, $id)
    {
        $state = $request->input('state');

        Order::find($id)->update(['state' => $state]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    }

    public function getOrders(){
        $orders = Order::with('orderproducts')->where('user_id', Auth::user()->id)->get();

        $data = array(
            "orders" => $orders,
        );

        $response = response()->json($data,200);
        return $response;
    }

    public function generateOrder(Request $request){
        $products = $request->input("orderproducts");
        $direction = $request->input("direction");
        $user_id = Auth::user()->id;
        $order_price = $request->input("order_price");
        $reward_points = $request->input("reward_points");

        $real_order_price = $this->checkOrderPrice($products);
        $real_reward_points = $real_order_price * 4;

        $state = "Enviado";
        $actual_date = Carbon::now()->addHours(2);

        $order = new Order();
        $order->user_id = $user_id;
        $order->orderDate = $actual_date;
        $order->reward_points = $real_reward_points;
        $order->total_price = $real_order_price;
        $order->state = $state;
        $order->direction = $direction;

        $order->save();
        $order_id = $order->id;

        foreach($products as $object){
            $id = $object['product']['id'];
            $quantity = $object['quantity'];
            $name = $object['product']['name'];

            if(isset($object['size'])){
                $size = $object['size'];
            }else{
                $size = null;
            }

            $values = array(
                'product_id' => $id,
                'product_name' => $name,
                'quantity' => $quantity,
                'size' => $size,
                'order_id' => $order_id,
            );$values2 = array(
                'order_id' => $order_id,
                'product_id' => $id
            );
            DB::table('order_products')->insert($values);
            DB::table('order_product')->insert($values2);
        }

        $this->updateRecommender($products);
    }

    public function updateRecommender($products){
        $recommenderText = Storage::get("recommender.json");
        $recommenderArray = json_decode($recommenderText,true);

        foreach($products as $object_0){
            $id_0 = $object_0['product']['id'];
            foreach($products as $object_1){
                $id_1 = $object_1['product']['id'];
                $values1 = array("product_id_0" => $id_0, "product_id_1" => $id_1);
                $values2 = array("product_id_0" => $id_1, "product_id_1" => $id_0);
                if($id_0 != $id_1 && (!in_array($values1,$recommenderArray) && !in_array($values2,$recommenderArray))){
                    array_push($recommenderArray,$values1);
                }
            }
        }

        Storage::put("recommender.json",json_encode($recommenderArray));
    }

    public function inArray($values, $array){
        $values1 = array("product_id_0" => 99, "product_id_1" => 99);
        array_push($array,$values1);
        info($array);
    }

    public function checkOrderPrice($products){
        $total_order_price = 0;
        foreach($products as $object){
            $id = $object['product']['id'];
            $quantity = $object['quantity'];
            if(isset($object['size'])){
                $size = $object['size'];
            }else{
                $size = "normal";
            }
            $product_price = $this->getProductPrice($id,$size);
            $total_order_price += $quantity * $product_price;
        }
        return $total_order_price;
    }

    public function getProductPrice($product_id,$product_size){
        $product = Product::find($product_id);
        $product_price = 0;
        switch ($product_size){
            case "pequeña":
                $product_price = $product->price_s;
                break;
            case "mediana":
                $product_price = $product->price_m;
                break;
            case "grande":
                $product_price = $product->price_l;
                break;
            case "brusquetta":
                $product_price = $product->price_b;
                break;
            default:
                $product_price = $product->price;
                break;
        }
        return $product_price;
    }

    public function repeatOrder(Request $request){
        $products = $request->input("orderproducts");
        $direction = $request->input("direction");
        $user_id = Auth::user()->id;
        $order_price = $request->input("order_price");
        $reward_points = $request->input("reward_points");


        $state = "Enviado";
        $actual_date = Carbon::now()->addHours(2);

        $order = new Order();
        $order->user_id = $user_id;
        $order->orderDate = $actual_date;
        $order->reward_points = $reward_points;
        $order->total_price = $order_price;
        $order->state = $state;
        $order->direction = $direction;

        $order->save();
        $order_id = $order->id;

        foreach($products as $object){
            $id = $object['product_id'];
            $quantity = $object['quantity'];
            $name = $object['product_name'];

            if(isset($object['size'])){
                $size = $object['size'];
            }else{
                $size = null;
            }
            $values = array(
                'product_id' => $id,
                'product_name' => $name,
                'quantity' => $quantity,
                'size' => $size,
                'order_id' => $order_id,
            );$values2 = array(
                'order_id' => $order_id,
                'product_id' => $id
            );
            DB::table('order_products')->insert($values);
            DB::table('order_product')->insert($values2);
        }
    }

    public function getOrderProductsById(Request $request){
        $order_id = $request->input("order_id");
        $orderproducts_info = Order::with('orderproducts')->where('id',$order_id)->get();
        $order_info = Order::with('products.ingredients')->where('id',$order_id)->get();


        $data = array(
            "products" => $order_info,
            "orderproducts" => $orderproducts_info
        );

        $response = response()->json($data,200);
        return $response;
    }

    public function transferPoints(Request $request){
        $user_id = $request->input("user_id");
        $order_id = $request->input("order_id");
        $points = $request->input("points");

        $user = User::find($user_id);
        $user->points = $user->points + $points;
        $user->save();

        $order = Order::find($order_id);
        $order->is_payed = true;
        $order->save();
    }
















}
