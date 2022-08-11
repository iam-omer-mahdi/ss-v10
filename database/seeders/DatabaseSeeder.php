<?php

namespace Database\Seeders;

use App\Models\Student;
use Database\Seeders\FeeSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\DiscountSeeder;
use Database\Seeders\LaratrustSeeder;
use Database\Factories\StudentFactory;
use Database\Seeders\NationalitySeeder;
use Database\Seeders\GuardianRelationSeeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        Student::factory()->count(160)->create();
        
        // $this->call(LaratrustSeeder::class);
        // $this->call([
        //     // UserSeeder::class,
        //     GuardianRelationSeeder::class,
        //     NationalitySeeder::class,
        //     DiscountSeeder::class,
        //     FeeSeeder::class,
        // ]);
    }
}
