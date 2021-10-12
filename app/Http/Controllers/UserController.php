<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Faker\Provider\Image;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $users;
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
            'name' => 'required',
            'surnames' => 'required',
            'email' => 'required',
            'photo' => 'required',
            'isAdmin' => 'required',
            'points' => 'required'
        ]);

        User::create($request->all());

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
        //
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
        User::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function changeimg(Request $request){
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/img/uploads', $filename);

            $user = User::find(Auth::id());
            if (strpos($user->photo, 'default') == false) {
                $photoName = explode("/", $user->photo)[7];
                $photoName = explode("/", $user->photo)[8];
                $string = addslashes("'assets'img'uploads'");
                $localPath = str_replace("'", "", $string);
                unlink(public_path() . $localPath . $photoName);
            }

            $user->photo = "http://localhost/impronta/public/assets/img/uploads/" . $filename;
            $user->save();
            $page = "changephoto";
            return view('user.user_content', compact('page'))->with('status', "Imagen de perfil actualizada correctamente");
        } else {
            $page = "changephoto";
            return view('user.user_content', compact('page'))->with('statuserror', "Imagen o formato inválido. Intentalo de nuevo más tarde.");
        }
    }

    public function getUserImage(){
        $data = array(
            'image' => Auth::user()->photo
        );
        $response = response()->json($data,200);
        return $response;
    }

    public function getUserDirection(){
        $data = array(
            'direction' => Auth::user()->direction
        );
        $response = response()->json($data,200);
        return $response;
    }

    public function getDontLikeIngredients(){
        $ingredients = array();
        $ingredients_id = Auth::user()->getDontLikesIngredients();
        foreach ($ingredients_id as $ingredient){
            $ing = Ingredient::find($ingredient->ingredient_id);
            if($ing != null){
                array_push($ingredients,$ing);
            }
        }

        $data = array(
            'ingredients' => $ingredients
        );
        $response = response()->json($data,200);
        return $response;

    }
    public function deleteNonLikedIngredientFromUser($ingredient_id){
        info($ingredient_id);
        DB::table('user_dontlike')
            ->where('user_id',Auth::user()->id)
            ->where('ingredient_id',$ingredient_id)
            ->delete();
    }


    public function addNonLikedIngredientToUser($ingredient_name){
        $ingredient_id = $this->getIngredientIdByName($ingredient_name);
        $values = array('user_id' => Auth::user()->id, 'ingredient_id' => $ingredient_id);
        DB::table('user_dontlike')->insert($values);
    }

    public function getIngredientIdByName($ingredient_name){
        $ingredient_id = Ingredient::where('name',$ingredient_name)->first()->id;
        return $ingredient_id;
    }

    public function changeUserDirection(Request $request){
        $new_direction = $request->input('direction');

        $user = Auth::user();

        $user->direction = $new_direction;
        $user->save();
    }


}
