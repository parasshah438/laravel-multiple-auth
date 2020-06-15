<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudenttableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => 'jay',
            'email' => 'jay@gmail.com',
            'password' => bcrypt('123456'),
            'image' => NULL,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
