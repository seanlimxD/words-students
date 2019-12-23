<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
    		'permission' => 'list_students',
    		'description' => 'List All Students'
    	]);

    	Permission::create([
    		'permission' => 'modify_all_students',
    		'description' => 'Edit/Delete information of all Students'
    	]);

        Permission::create([
            'permission' => 'create_students',
            'description' => 'Create or enroll new Students'
        ]);

        Permission::create([
            'permission' => 'create_words',
            'description' => 'Create new words'
        ]);

        Permission::create([
            'permission' => 'edit_words',
            'description' => 'Edit/Delete words'
        ]);
    }
}
