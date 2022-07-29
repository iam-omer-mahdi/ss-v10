<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fees')->insert([ 'name' => 'رسوم التسجيل','type' => 1 ]);
        DB::table('fees')->insert([ 'name' => 'الرسوم الدراسية','type' => 2 ]);
    }
}
