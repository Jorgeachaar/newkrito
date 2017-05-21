<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReNewPlanController extends Controller
{
    public function index()
    {
    	return view('renewplan');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'plan' => 'required|in:1,2,3',
    	]);

    	$user = Auth::user();

    	$profile = $user->profile;

    	switch ($request->input('plan')) {
            case '1':
                $end_plan = Carbon::now()->addYears(1);
                break;
            case '2':
                $end_plan = Carbon::now()->addYears(2);
                break;
            case '3':
                $end_plan = Carbon::now()->addYears(5);
                break;
            default:
                break;
        }

        $profile->end_plan = $end_plan;
    	$profile->save();

    	return redirect()->route('index');


    }
}
