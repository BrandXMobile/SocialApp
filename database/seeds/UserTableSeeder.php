<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $role_user=Role::where('name','User')->first();
        $role_admin=Role::where('name','Admin')->first();
        $role_author=Role::where('name','Author')->first();

		//order important
        $user=new User();
        $user->first_name='Ante';
        $user->email='ante@gmail.com';
        $user->password=bcrypt('ante');
        $user->save();
        $user->roles()->attach($role_user);

        $admin=new User();
        $admin->first_name='Joke';
        $admin->email='joke@gmail.com';
        $admin->password=bcrypt('joke');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $author=new User();
        $author->first_name='Naka';
        $author->email='naka@gmail.com';
        $author->password=bcrypt('naka');
        $author->save();
        $author->roles()->attach($role_author);
    }
}
