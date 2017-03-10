<?php
// |

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function createPost(Request $request)
    {
		//Validation
		$this->validate($request,[
			'body'=>'required|max:1000'
		]);
		
		$post=new Post();
		$post->body=$request['body'];
		$message="Ouups,....error!";
		if($request->user()->posts()->save($post)){
			$message="Post cretaed sucessfully!!";
		} 

		return redirect()->route('dashboard')->withMessage($message);
    }
}
