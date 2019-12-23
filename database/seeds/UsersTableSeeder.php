<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::create([
    		'name' => 'Me',
    		'email' => 'me@me.com',
    		'password' => Hash::make('me')
    	]);

    	User::create([
    		'name' => 'Myself',
    		'email' => 'myself@myself.com',
    		'password' => Hash::make('myself')
    	]);

        User::create([
            'name' => 'Wo',
    		'email' => 'wo@wo.com',
    		'password' => Hash::make('wo')
        ]);

        User::create([
            'name' => 'Watashi',
    		'email' => 'watashi@watashi.com',
    		'password' => Hash::make('watashi')
        ]);

        User::create([
            'name' => 'Mihi',
    		'email' => 'mihi@mihi.com',
    		'password' => Hash::make('mihi')
        ]);
    }
}
