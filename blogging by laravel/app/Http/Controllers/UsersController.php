<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){

        return view('admin.users.index')->with('users', User::all());
    }

    public function create(){

        return view('admin.users.create');
    }


    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => bcrypt('password')
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/1.jpg'
        ]);

        Session::flash('success' , 'user added');

        return redirect()->route('users');
    }


    public function admin($id){

        $user = User::find($id);

        $user->admin  = 1;

        $user->save();

        Session::flash('success', 'successfully changed user permissions');

        return redirect()->back();
    }

    public function Notadmin($id){

        $user = User::find($id);

        $user->admin  = 0;

        $user->save();

        Session::flash('success', 'successfully changed user permissions');

        return redirect()->back();
    }

    public function destroy($id){

        $user = User::find($id);

        $user->profile->delete();

        $user->delete();

        Session::flash('success', 'user and profile deleted');

        return redirect()->back();
    }
}
