<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $this->call(UsertableSeeder::class);
        $this->call(AdmintableSeeder::class);
        $this->call(StudenttableSeeder::class);
        $this->call(TeachertableSeeder::class);
    }
}
