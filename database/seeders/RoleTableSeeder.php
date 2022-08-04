<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'super_admin',
            'display_name' => 'المشرف الرئيسي',
            'description' => 'يستطيع عمل اي شي في النظام',
        ]);
        
        Role::create([
            'name' => 'finance_manager',
            'display_name' => 'المدير المالي',
            'description' => 'يستطيع التحكم في النظام المالي',
        ]);

        Role::create([
            'name' => 'accountant',
            'display_name' => 'محاسب',
            'description' => 'لايستطيع الحذف او التعديل في النظام المالي',
        ]);

        Role::create([
            'name' => 'results_manager',
            'display_name' => 'مدير النتائج',
            'description' => 'يستطيع التحكم في نظام النتائج',
        ]);
    }
}
