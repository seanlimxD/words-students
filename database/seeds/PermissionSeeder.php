<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
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
    }
}
