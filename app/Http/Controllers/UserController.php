<?php
// |

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        //attach default user public role for every new user
        $user->roles()->attach(Role::where('name','User')->first());

    	Auth::login($user);

    	//return redirect()->back();
    	return redirect()->route('dashboard');
    }

    public function doLogin(Request $request)
    {
    	$this->validate($request,[
    		'email'=> 'required',
    		'password' => 'required'
    	]);

		if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']])){
			return redirect()->route('dashboard');
		}

		return redirect()->back();
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    /*ACCOUNT CHANGES*/
    public function getAccount()
    {
        return view('account',['user'=>Auth::user()]);
    }

    public function saveAccount(Request $request)
    {
        $this->validate($request,[
            'first_name'=> 'required|max:28',
        ]);

        $account=Auth::user();
        $account->first_name=$request['first_name'];
        //$account->image=$request['image'];
        $account->update();

        //save image
        $file=$request->file('image');
        $filename=$request['first_name']."-".$account->id.".jpg";
        
        if($file){
            Storage::disk('local')->put($filename,File::get($file));
        }

        return redirect()->route('account');
    }

    public function getUserImage($filename)
    {
        $file=Storage::disk('local')->get($filename);

        return new Response($file,200);
    }

    /*ACL Part*/
     public function getAuthorPage()
    {
        return view('author');
    }

    public function getAdminPage()
    {
        $users = User::all();
        return view('admin', ['users' => $users]);
    }

    public function getGenerateArticle()
    {
        return response('Article generated!', 200);
    }
    
    public function postAdminAssignRoles(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        if ($request['role_user']) {
            $user->roles()->attach(Role::where('name', 'User')->first());
        }
        if ($request['role_author']) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if ($request['role_admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        return redirect()->back();
    }
}

