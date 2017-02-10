<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function edit(Setting $setting)
    {
        return view('admin.settings.form');
    }

    public function update(Request $request, Setting $setting)
    {
        //
    }
}
