<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //raspored zvanja je bitan!! Prvo role pa onda user seeder koji poziva role unutar sebe :)
       $this->call(RoleTableSeeder::class);
       $this->call(UserTableSeeder::class);
    }
}
