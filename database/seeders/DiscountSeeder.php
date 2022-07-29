<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert([ 'name' => 'لايوجد تخفيض','amount' => 0 ]);
        DB::table('discounts')->insert([ 'name' => 'طالب واحد','amount' => 5 ]);
        DB::table('discounts')->insert([ 'name' => 'اخويين','amount' => 10 ]);
        DB::table('discounts')->insert([ 'name' => '3 اخوان','amount' => 15 ]);
        DB::table('discounts')->insert([ 'name' => '4 اخوان او اكثر','amount' => 20 ]);
        DB::table('discounts')->insert([ 'name' => 'ابناء عاملين','amount' => 75 ]);
    }
}
