<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	//@@@ - parameter for assign middle table name to other than laravel default match up
    public function users()
	{
		return $this->belongsToMany('App\User'/*@@@@,'user_role','user_id','role_id'*/);
	}

}
