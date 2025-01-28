<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $name = $user->name;
        $email = $user->email;

        $splitName = explode(' ', $name, 2);

        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';
        return view('home.users_profile.index' ,compact('first_name','last_name' ,'email'));
    }
    public function edit( Request $request){

       $user = auth()->user()  ;
       $user->name = $request->first_name . " ". $request->last_name;
       $user->save();

        return redirect()->route('home.users_profile.index');
    }
}
