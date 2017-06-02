<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\PicCategory;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $mainCategories = PicCategory::getMainCategory();
        

        return view('index', compact('mainCategories'));
    }

    public function sendContact(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        try 
        {
            Mail::to('henryanglas@hotmail.com', 'Henry Anglas')->send(new Contact($name, $email, $message));
            $message = "Su mensaje fue enviado con éxito.";
        } catch (\Exception $e) {
            $message = 'Excepción capturada: ' .  $e->getMessage();
            $message = 'Hubo un error al enviar su email, intentalo más tarde';
        }


        if ($request->ajax()) {
            return response()->json([
                    'message' => $message
                ]);
        }
        else
        {
            Session::flash('message', $message);
            return back();
        }
    }

    public function changePassword()
    {
        return view('auth.passwords.change');
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);
        
        $user = auth()->user();
        $oldpass = $request->input('oldpassword');
        $pass = $request->input('password');

        if(\Hash::check($oldpass, $user->getAuthPassword())){
            $user->password = bcrypt($pass);
            $user->save();  
            return redirect()->route('index');
        } else {
            return back()->withErrors('Your old password is incorrect.');
            
        }
    }

    public function loginCart()
    {
        return redirect()->intended(route('cart.detail'));
    }
}
