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

        Permission::create([
            'permission' => 'create_permissions',
            'description' => 'Create new Permissions'
        ]);

        Permission::create([
            'permission' => 'edit_permissions',
            'description' => 'Edit/Delete Permissions'
        ]);

        Permission::create([
            'permission' => 'grant_permissions',
            'description' => 'Grant Permissions to Users'
        ]);

        Permission::create([
            'permission' => 'create_courses',
            'description' => 'Create new Courses'
        ]);

        Permission::create([
            'permission' => 'edit_courses',
            'description' => 'Edit/Delete Courses'
        ]);

        Permission::create([
            'permission' => 'view_courses',
            'description' => 'View Course Information'
        ]);
    }
}
