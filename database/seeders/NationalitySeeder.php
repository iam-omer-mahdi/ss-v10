<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationalities')->insert([ 'country' => 'السودان' ]);
        DB::table('nationalities')->insert([ 'country' => 'جنوب السودان', ]);
        DB::table('nationalities')->insert([ 'country' => 'سوريا', ]);
        DB::table('nationalities')->insert([ 'country' => 'مصر', ]);
        DB::table('nationalities')->insert([ 'country' => 'السعودية', ]);
        DB::table('nationalities')->insert([ 'country' => 'الامارات', ]);
        DB::table('nationalities')->insert([ 'country' => 'ليبيا', ]);
        DB::table('nationalities')->insert([ 'country' => 'اليمن', ]);
        DB::table('nationalities')->insert([ 'country' => 'العراق', ]);
        DB::table('nationalities')->insert([ 'country' => 'اثيوبيا', ]);
        DB::table('nationalities')->insert([ 'country' => 'تونس', ]);
        DB::table('nationalities')->insert([ 'country' => 'الجزائر', ]);
        DB::table('nationalities')->insert([ 'country' => 'المغرب', ]);
        DB::table('nationalities')->insert([ 'country' => 'موريتانيا', ]);
        DB::table('nationalities')->insert([ 'country' => 'تشاد', ]);
        DB::table('nationalities')->insert([ 'country' => 'الصومال', ]);
        DB::table('nationalities')->insert([ 'country' => 'عمان', ]);
        DB::table('nationalities')->insert([ 'country' => 'الكويت', ]);
        DB::table('nationalities')->insert([ 'country' => 'فلسطين', ]);
        DB::table('nationalities')->insert([ 'country' => 'لبنان', ]);
        DB::table('nationalities')->insert([ 'country' => 'قطر', ]);
        DB::table('nationalities')->insert([ 'country' => 'البحرين', ]); 
    }
}
