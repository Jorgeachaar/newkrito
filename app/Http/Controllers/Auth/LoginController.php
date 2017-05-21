<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->isAdmin()) {
            $end_plan = $user->profile->end_plan;
            $diffInDays = Carbon::now()->diffInDays($end_plan, false);
            if ($diffInDays > 0 and $diffInDays < 10) {
                Session::flash('message', "Su plan esta por expirar en " . $diffInDays . " días.");
            }
            if ($diffInDays <= 0 ) {
                Session::flash('message', "Su plan esta vencido.");
            }
        }
    }
}
