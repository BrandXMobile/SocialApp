<?php
// |

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getDashboard()
    {
    	return view('dashboard');
    }

    public function doSignUp(Request $request)
    {
    	$this->validate($request,[
    		'email'=> 'email|unique:users',
    		'first_name' => 'required|max:120',
    		'password' => 'required|min:8'
    	]);
    	$email=$request['email'];
    	$first_name=$request['first_name'];
    	$password=bcrypt($request['password']);

    	$user=new User();
    	$user->email=$email;
    	$user->first_name=$first_name;
    	$user->password=$password;

    	$user->save();

    	Auth::login($user);

    	//return redirect()->back();
    	return redirect()->route('dashboard');
    }

    public function doLogin(Request $request)
    {
    	$this->validate($request,[
    		'email'=> 'email',
    		'password' => 'required'
    	]);

		if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']])){
			return redirect()->route('dashboard');
		}

		return redirect()->back();
    }
}
