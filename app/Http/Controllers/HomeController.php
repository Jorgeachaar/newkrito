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
}
