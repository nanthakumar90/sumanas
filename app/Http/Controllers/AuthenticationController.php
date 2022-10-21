<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
		if(Auth::check()){
			return redirect('product');
		}
		
		if($request->isMethod('post')){
			$validator = Validator::make($request->all(), [
				'email' => 'required|email',
				'password' => 'required'
			]);
	 
			if ($validator->fails()) {
				return redirect('/')->withErrors($validator)->withInput();
			}
			
			if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
				$request->session()->regenerate();
				return redirect('product');
			}
			
			return redirect('/')->withErrors(['invalidcredentials' => ['Invalid Credentials']])->withInput();
		}
		
        return view('authentication.login');
    }
	
	public function logout()
    {
		Auth::logout();
		return redirect('/');
    }
}
