<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Cart;

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'plan' => 'required|in:1,2,3',
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $request->session()->put('email_register', $request->input('name'));
        $request->session()->put('name_register', $request->input('email'));
        $request->session()->put('pass_register', $request->input('password'));
        $request->session()->put('plan_register', $request->input('plan'));
        
        Cart::destroy();
        
        switch ($request->input('plan')) {
            case '1':
                Cart::add('plan 1', 'plan 1 for 1 years', 1, 25);
                $years = 1;
                break;
            case '2':
                Cart::add('plan 2', 'plan 2 for 2 years', 1, 45);
                $years = 2;
                break;
            case '3':
                Cart::add('plan 3', 'plan 3 for 5 years', 1, 95);
                $years = 5;
                break;
            default:
                $years = 0;
                break;
        }

        return redirect()->route('payment.register');
        
    }

    protected function create(array $data)
    {
        // DB::beginTransaction();
        // try {
        //     $user = User::create([
        //         'name' => $data['name'],
        //         'email' => $data['email'],
        //         'password' => bcrypt($data['password']),
        //     ]);

        //     switch ($data['plan']) {
        //         case '1':
        //             $years = 1;
        //             break;
        //         case '2':
        //             $years = 2;
        //             break;
        //         case '3':
        //             $years = 5;
        //             break;
        //         default:
        //             $years = 0;
        //             break;
        //     }

        //     $end_plan = Carbon::now()->addYears(1);

        //     $user->profile()->create([
        //         'user_id' => $user->id,
        //         'plan' => $data['plan'],
        //         'start_plan' => Carbon::now(),
        //         'end_plan' => Carbon::now()->addYears($years),
        //     ]);

        //     DB::commit();
            
        // } catch (Exception $e) {
        //     DB::rollBack();
        // }

        // return $user;
    }
}
