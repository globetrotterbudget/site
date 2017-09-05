<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\Factory::create();
		
		$user = new User();
		for($i = 1; $i <= 10; $i++){
			$user = new App\User();
    		$user->email = $faker->email;
    		$user->name = $faker->name;
    		$user->password = Hash::make(env('USER_PASSWORD'));
    		$user->save();
    	}
    }
}
