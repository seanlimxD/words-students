<?php

use Illuminate\Database\Seeder;
use App\Word;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Word::create([
    		'word' => 'A',
    		'definition' => 'A',
    		'pronunciation' => 'A',
    		'usage' => 'A',
    		'lexile_level' => '1'
    	]);

		Word::create([
    		'word' => 'B',
    		'definition' => 'B',
    		'pronunciation' => 'B',
    		'usage' => 'B',
    		'lexile_level' => '1'
    	]);

		Word::create([
    		'word' => 'C',
    		'definition' => 'C',
    		'pronunciation' => 'C',
    		'usage' => 'C',
    		'lexile_level' => '1'
    	]);

		Word::create([
    		'word' => 'D',
    		'definition' => 'D',
    		'pronunciation' => 'D',
    		'usage' => 'D',
    		'lexile_level' => '1'
    	]);

		Word::create([
    		'word' => 'E',
    		'definition' => 'E',
    		'pronunciation' => 'E',
    		'usage' => 'E',
    		'lexile_level' => '1'
    	]);

    	Word::create([
    		'word' => 'A',
    		'definition' => 'A',
    		'pronunciation' => 'A',
    		'usage' => 'A',
    		'lexile_level' => '2'
    	]);

    	Word::create([
    		'word' => 'B',
    		'definition' => 'B',
    		'pronunciation' => 'B',
    		'usage' => 'B',
    		'lexile_level' => '2'
    	]);

    	Word::create([
    		'word' => 'C',
    		'definition' => 'C',
    		'pronunciation' => 'C',
    		'usage' => 'C',
    		'lexile_level' => '2'
    	]);

    	Word::create([
    		'word' => 'D',
    		'definition' => 'D',
    		'pronunciation' => 'D',
    		'usage' => 'D',
    		'lexile_level' => '2'
    	]);

    	Word::create([
    		'word' => 'E',
    		'definition' => 'E',
    		'pronunciation' => 'E',
    		'usage' => 'E',
    		'lexile_level' => '2'
    	]);
    }
}
