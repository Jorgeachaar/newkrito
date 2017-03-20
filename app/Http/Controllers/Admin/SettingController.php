<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function edit(Setting $setting)
    {
    	$item = Setting::getSetting();

        return view('admin.settings.form', compact('item'));
    }

    public function update(Request $request)
    {
    	$setting = Setting::getSetting();

    	$this->validate($request, [
    		'facebook' => 'required',
    		'twitter' => 'required',
    		'instagram' => 'required',
    		'wishlist' => 'required',
    		'about' => 'required',
    		'contact' => 'required',
    	]);

    	$setting->fill($request->all());
    	$setting->save();

    	return back();
    }
}
