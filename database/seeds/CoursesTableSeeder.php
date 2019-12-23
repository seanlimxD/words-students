<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Course::create([
    		'course' => 'c1',
    		'description' => 'd1',
    		'user_id' => '1'
    	]);

    	Course::create([
    		'course' => 'c2',
    		'description' => 'd2',
    		'user_id' => '1'
    	]);

        Course::create([
            'course' => 'c3',
            'description' => 'd3',
    		'user_id' => '1'
        ]);

        Course::create([
            'course' => 'c4',
            'description' => 'd4',
    		'user_id' => '2'
        ]);

        Course::create([
            'course' => 'c5',
            'description' => 'd5',
    		'user_id' => '2'
        ]);
    }
}
