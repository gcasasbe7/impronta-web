<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetEmail;
use App\Mail\ResetPasswordEmail;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetEmailController extends Controller
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


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendNewEmail(Request $request)
    {
        $user_email = $request->input('email-reset');

        $user = User::where('email', $user_email)->first();


        if ($user === NULL) {
            return back()->with('statuserror', 'No hemos encontrado el correo introducido.');
        } else {

            Mail::to($user_email)->send(new ResetEmail($user));

            return redirect('user-changeemail')->with('status', 'Te hemos enviado un correo con tus nuevos datos de acceso. Porfavor revisa tu bandeja de entrada.');
            //return back()->with('status', 'Te hemos enviado un correo con tus nuevos datos de acceso. Porfavor revisa tu bandeja de entrada.');
        }
    }

    public function resetUserEmail($token)
    {
        $user = User::where('remember_token', $token)->first();
        if($user != null){
            return redirect('user-changeemail')->with('status', 'Por favor, introduce tus nuevos datos de acceso.')->with('user_id', $user->id);
        }else{
            return redirect('user-changeemail')->with('statuserror', 'Algo salió mal. Por favor, intentalo de nuevo más tarde');
        }
    }

    public function refreshUserEmail(Request $request)
    {
        $new_email = $request->input('new-email');
        $new_email_repeat = $request->input('new-email-repeat');
        $user_id = $request->input('user-id');

        $user = User::findOrFail($user_id);

        if ($new_email === $new_email_repeat) {
            $user->email = $new_email;
            $user->save();
            return redirect('user-changeemail')->with('status', 'Email actualizado correctamente');
            //return back()->with('status', 'Contraseña actualizada correctamente. Puedes iniciar sesión con tus nuevos datos.');
        } else {
            return redirect('user-changeemail')->with('statuserror', 'Los correos electrónicos no coinciden. Vuelve a intentarlo.');
            //return back()->with('statuserror', 'Las contraseñas no coinciden. Vuelve a intentarlo.');
        }
    }

}
