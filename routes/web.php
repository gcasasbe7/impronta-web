<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', 'PageController@index');
Route::get('/menu', 'PageController@menu');
Route::get('/ofertas', 'PageController@ofertas');
Route::get('/nosotros', 'PageController@nosotros');
Route::get('/myorder', 'PageController@newOrder')->middleware('auth');
Route::get('/loginregister', 'PageController@loginregister')->middleware('customguest');
Route::get('/home', function(){return redirect('/');});

Route::get('/getuserdirection','UserController@getUserDirection');
Route::get('/productsbytype','ProductController@getProductsByType');
Route::get('/productsbytypeorder','ProductController@getProductsByTypeOrder');
Route::get('/getuserpizzas','ProductController@getUserPizzas');
Route::get('/comments/{product_id}','ProductController@getComments');
Route::post('/comments/{product_id}','ProductController@getComments');
Route::post('deleteLike','ProductController@deleteLike')->middleware('auth');
Route::post('addComment','CommentController@addComment')->middleware('auth');
Route::post('deleteComment','CommentController@deleteComment')->middleware('auth');
Route::post('addLike','ProductController@addLike')->middleware('auth');
Route::get('getingredientsnames','ProductController@getIngredientsName')->middleware('auth');
Route::get('getproductsnames','ProductController@getProductsName')->middleware('auth');
Route::get('getfavs','ProductController@getUserFavs')->middleware('auth');
Route::get('getdontlikeingredients','UserController@getDontLikeIngredients')->middleware('auth');
Route::get('getbooks','BookController@getBooks')->middleware('auth');
Route::get('getorders','OrderController@getOrders')->middleware('auth');
Route::get('getvouchers','VoucherController@getUserVouchers')->middleware('auth');
Route::post('createmypizza','ProductController@createMyPizza')->middleware('auth');
Route::post('generatebook','BookController@generateBook')->middleware('auth');
Route::post('changeimage','UserController@changeImage')->middleware('auth')->name('change.image');
Route::delete('products/{product_id}','ProductController@deleteMyPizza')->middleware('auth');
Route::post('generateVoucher','VoucherController@generateVoucher')->middleware('auth');
Route::post('neworder','OrderController@generateOrder')->middleware('auth');
Route::post('repeatorder','OrderController@repeatOrder')->middleware('auth');
Route::post('userdontlike/{ingredient_name}','UserController@addNonLikedIngredientToUser')->middleware('auth');
Route::post('deleteuserdontlike/{ingredient_name}','UserController@deleteNonLikedIngredientFromUser')->middleware('auth');
Route::delete('orders/{id}','OrderController@destroy')->middleware('auth');
Route::post('uploadimage','UserController@changeimg')->middleware('auth');
Route::get('getuserimage','UserController@getUserImage')->middleware('auth');
Route::post('changeuserdirection','UserController@changeUserDirection')->middleware('auth');
Route::get('getrecommendations','ProductController@getLocalRecommendations')->middleware('auth');
Route::post('getuserrecommendations','ProductController@getUserRecommendations')->middleware('auth');


Route::get('/user', 'PageController@userHome')->middleware('auth');
Route::get('/user-orders', 'PageController@userOrders')->middleware('auth');
Route::get('/user-books', 'PageController@userBooks')->middleware('auth');
Route::get('/user-favs', 'PageController@userFavs')->middleware('auth');
Route::get('/user-pizzas', 'PageController@userPizzas')->middleware('auth');
Route::get('/user-points', 'PageController@userPoints')->middleware('auth');
Route::get('/user-config', 'PageController@userConfig')->middleware('auth');
Route::get('/user-dontlike', 'PageController@userDontLike')->middleware('auth');
Route::get('/user-changeemail', 'PageController@userChangeEmail')->middleware('auth');
Route::get('/user-changephoto', 'PageController@userChangePhoto')->middleware('auth');
Route::get('/user-changedirection', 'PageController@userChangeDirection')->middleware('auth');

Route::resource('/housekeeping/orders','OrderController')->middleware('administrator');
Route::resource('/housekeeping/ingredients','IngredientController')->middleware('administrator');
Route::resource('/housekeeping/books','BookController')->middleware('administrator');
Route::resource('/housekeeping/products','ProductController')->middleware('administrator');
Route::resource('/housekeeping/events','EventController')->middleware('administrator');
Route::resource('/housekeeping/users','UserController')->middleware('administrator');
Route::get('/housekeeping/carta/{id}', 'ProductController@getIngredients')->middleware('administrator');
Route::get('/housekeeping/getingredientsnames','ProductController@getIngredientsName')->middleware('auth');
Route::delete('/housekeeping/carta/{ingredient_id}/{product_id}', 'ProductController@deleteIngredientFromProduct')->middleware('administrator');
Route::post('/housekeeping/carta/{ingredient_name}/{product_id}', 'ProductController@addIngredientToProduct')->middleware('administrator');
Route::post('/housekeeping/validateVoucher', 'VoucherController@validateVoucher')->middleware('administrator');
Route::get('/housekeeping/getVouchers','VoucherController@getVouchers')->middleware('administrator');
Route::put('/housekeeping/updateBookState/{id}', 'BookController@updateState')->middleware('administrator');
Route::put('/housekeeping/updateOrderState/{id}', 'OrderController@updateState')->middleware('administrator');
Route::post('/housekeeping/transferPoints', 'OrderController@transferPoints')->middleware('administrator');
Route::post('/housekeeping/generateevent','EventController@generateEvent')->middleware('auth');
Route::post('/housekeeping/getOrderProductsById','OrderController@getOrderProductsById')->middleware('auth');
Route::post('/housekeeping/generatebook','BookController@generateBook')->middleware('administrator');
Route::post('/housekeeping/generatepromotion','EventController@generatePromotion')->middleware('auth');


Route::get('/housekeeping', function(){return redirect('/housekeeping/dashboard');});
Route::get('/housekeeping/dashboard', 'PageController@home')->middleware('administrator');
Route::get('/housekeeping/pedidos', 'PageController@pedidos')->middleware('administrator');
Route::get('/housekeeping/reservas', 'PageController@reservas')->middleware('administrator');
Route::get('/housekeeping/carta', 'PageController@carta')->middleware('administrator');
Route::get('/housekeeping/eventos', 'PageController@eventos')->middleware('administrator');
Route::get('/housekeeping/usuarios', 'PageController@usuarios')->middleware('administrator');
Route::get('/housekeeping/ingredientes', 'PageController@ingredientes')->middleware('administrator');
Route::get('/housekeeping/vouchers', 'PageController@vouchers')->middleware('administrator');

