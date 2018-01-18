<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegistrationController extends Controller
{
    public function create() {
    	return view('registration.create');
    }

    public function store() { 
    	$this->validate(request(), [
           'name' =>'required',
           'email' => 'required|email',
           'password' => 'required|confirmed' 
    	]);
    	///$name = Request('name');
    	//$email = Request('email');
    	//$password = Request('password');

    	$user=User::create([

    		'name' => request('name'), 
    		'email' => request('email'),
    		'password' => Hash::make(request('password'))]);

    	auth()->login($user);

    	return redirect()->home();
    }
}
