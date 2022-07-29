<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuardianRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guardian_relations')->insert([ 'relation' => 'اب' ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'ام', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'جد', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'جدة', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'عم', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'عمة', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'خال', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'خالة', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'اخ', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'اخت', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'ابن عم', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'ابن عمة', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'ابن خال', ]);
        DB::table('guardian_relations')->insert([ 'relation' => 'ابن خالة', ]);

    }
}
