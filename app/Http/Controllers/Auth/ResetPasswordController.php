<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendNewPassword(Request $request)
    {
        $user_email = $request->input('email-reset');

        $user = User::where('email', $user_email)->first();


        if ($user === NULL) {
            return back()->with('statuserror', 'No hemos encontrado el correo introducido.');
        } else {

            Mail::to($user_email)->send(new ResetPasswordEmail($user));

            return back()->with('status', 'Te hemos enviado un correo con tus nuevos datos de acceso. Porfavor revisa tu bandeja de entrada.');
        }
    }

    public function resetUserPassword($token)
    {
        $user = User::where('remember_token', $token)->first();
        if($user != null){
            return redirect('loginregister')->with('status', 'Por favor, introduce tus nuevos datos de acceso.')->with('user_id', $user->id);
        }else{
            return redirect('loginregister')->with('statuserror', 'Algo salió mal. Por favor, vuelve a intentarlo de nuevo más tarde.');
        }
    }

    public function refreshUserPassword(Request $request)
    {
        $new_password = $request->input('new-password');
        $new_password_repeat = $request->input('new-password-repeat');
        $user_id = $request->input('user-id');

        $user = User::findOrFail($user_id);

        if ($new_password === $new_password_repeat) {
            $user->password = bcrypt($new_password);
            $user->save();
            return back()->with('status', 'Contraseña actualizada correctamente. Puedes iniciar sesión con tus nuevos datos.');
        } else {
            return back()->with('statuserror', 'Las contraseñas no coinciden. Vuelve a intentarlo.');
        }
    }

    public function refreshPasswordLogged(Request $request)
    {
        $old_password = $request->input('old-password');
        $new_password = $request->input('new-password');
        $new_password_repeat = $request->input('new-password-repeat');
        $user_id = $request->input('user-id');

        $user = User::findOrFail($user_id);

        if (bcrypt($old_password) === $user->password) {
            if ($new_password === $new_password_repeat) {
                $user->password = bcrypt($new_password);
                $user->save();
                return back()->with('status', 'Contraseña actualizada correctamente.');
            } else {
                return back()->with('statuserror', 'Las contraseñas no coinciden. Vuelve a intentarlo.');
            }
        } else {
            return back()->with('statuserror', 'Contraseña incorrecta.');
        }
    }
}
