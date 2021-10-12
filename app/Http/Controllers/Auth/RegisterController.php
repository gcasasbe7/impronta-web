<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ConfirmationEmail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surnames' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surnames' => $data['surnames'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if($request->input('recievePromotions') == "on"){
            $user->recievePromotions = 1;
            $user->save();
        }

        Mail::to($user->email)->send(new ConfirmationEmail($user));

        return back()->with('status','Te hemos enviado un correo. Porfavor confirma tu dirección de correo electrónico.');
    }

    public function confirmEmail($token){
        $user = User::where('token', $token)->first();
        if($user != null){
            $user->hasVerified();
            return redirect('loginregister')->with('status', 'Gracias por confirmar tu correo electrónico. Puedes iniciar sesión.');
        }else{
            return redirect('loginregister')->with('statuserror', 'Algo salió mal. Por favor vuelve a confirmar tu dirección de correo electrónico');
        }
    }
}
