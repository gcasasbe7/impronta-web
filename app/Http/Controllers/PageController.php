<?php

namespace App\Http\Controllers;

use App\Achievement;
use Illuminate\Http\Request;
use App\Event;
use App\Product;
use App\Order;
use App\User;
use App\Ingredient;
use App\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notification;

class PageController extends Controller
{
    public function index(){
        $start = microtime(true);
        $events = Event::all();
        $user_id = Auth::id();
        $end = microtime(true);

        info("GETTING WELCOME PAGE:" . ($end - $start));
        return view('welcome')->with(compact('events','user_id'));
    }

    public function menu(){
        $content = "pizzas";
        return view('menu',compact('content'));
    }
    public function ofertas(){
        return view('ofertas');
    }
    public function nosotros(){
        return view('nosotros');
    }

    public function newOrder(){
        return view('newOrder');
    }

    public function loginregister(){
        return view('loginregister');
    }

    public function userHome(){
        $page = "home";
        return view('user.user_content',compact('page'));
    }
    public function userOrders(){
        $page = "orders";
        return view('user.user_content',compact('page'));
    }
    public function userBooks(){
        $page = "books";
        return view('user.user_content',compact('page'));
    }
    public function userFavs(){
        $page = "favs";
        return view('user.user_content',compact('page'));
    }
    public function userPizzas(){
        $page = "pizzas";
        return view('user.user_content',compact('page'));
    }
    public function userConfig(){
        $page = "config";
        return view('user.user_content',compact('page'));
    }
    public function userPoints(){
        $page = "points";
        return view('user.user_content',compact('page'));
    }
    public function userDontLike(){
        $page = "dontlike";
        return view('user.user_content',compact('page'));
    }
    public function userChangePassword(){
        $page = "changepassword";
        return view('user.user_content',compact('page'));
    }
    public function userChangeEmail(){
        $page = "changeemail";
        return view('user.user_content',compact('page'));
    }
    public function userChangePhoto(){
        $page = "changephoto";
        return view('user.user_content',compact('page'));
    }
    public function userChangeDirection(){
        $page = "changedirection";
        return view('user.user_content',compact('page'));
    }






    public function home()
    {
        return view('housekeeping.dashboard');
    }

    public function pedidos()
    {
        return view('housekeeping.pedidos');
    }

    public function reservas()
    {
        return view('housekeeping.reservas');
    }

    public function carta()
    {
        return view('housekeeping.carta');
    }

    public function eventos()
    {
        return view('housekeeping.eventos');
    }

    public function usuarios()
    {
        return view('housekeeping.usuarios');
    }

    public function ingredientes()
    {
        return view('housekeeping.ingredientes');
    }
    public function vouchers()
    {
        return view('housekeeping.vouchers');
    }
}