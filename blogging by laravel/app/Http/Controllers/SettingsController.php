<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index(){

            return view('admin.settings.setting')->with('setting', Setting::first());
    }


    public function update(){

        $this->validate(request(),[
            'site_name' => 'required',
            'adress' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required'
        ]);

        $setting = Setting::first();

        $setting->site_name = request()->site_name;
        $setting->adress = request()->adress;
        $setting->contact_number = request()->contact_number;
        $setting->contact_email = request()->contact_email;

        $setting->save();

        Session::flash('success' , 'your settings updated');

        return redirect()->back();

    }
}
