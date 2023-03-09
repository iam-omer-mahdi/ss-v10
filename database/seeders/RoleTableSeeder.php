<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions 🔑 
        // User 👨
        Permission::create(['name' => 'create_user']);
        Permission::create(['name' => 'read_user']);
        Permission::create(['name' => 'update_user']);
        Permission::create(['name' => 'delete_user']);
        // Student 👨
        Permission::create(['name' => 'create_student']);
        Permission::create(['name' => 'read_student']);
        Permission::create(['name' => 'update_student']);
        Permission::create(['name' => 'delete_student']);
        // School 🏫
        Permission::create(['name' => 'create_school']);
        Permission::create(['name' => 'read_school']);
        Permission::create(['name' => 'update_school']);
        Permission::create(['name' => 'delete_school']);
        // Grade 📅
        Permission::create(['name' => 'create_grade']);
        Permission::create(['name' => 'read_grade']);
        Permission::create(['name' => 'update_grade']);
        Permission::create(['name' => 'delete_grade']);
        // Classroom 📚
        Permission::create(['name' => 'create_classroom']);
        Permission::create(['name' => 'read_classroom']);
        Permission::create(['name' => 'update_classroom']);
        Permission::create(['name' => 'delete_classroom']);
        // Discount 📉 
        Permission::create(['name' => 'create_discount']);
        Permission::create(['name' => 'read_discount']);
        Permission::create(['name' => 'update_discount']);
        Permission::create(['name' => 'delete_discount']);
        // Fee 💰
        Permission::create(['name' => 'create_fee']);
        Permission::create(['name' => 'read_fee']);
        Permission::create(['name' => 'update_fee']);
        Permission::create(['name' => 'delete_fee']);
        // Transportation 🚌 
        Permission::create(['name' => 'create_transportation']);
        Permission::create(['name' => 'read_transportation']);
        Permission::create(['name' => 'update_transportation']);
        Permission::create(['name' => 'delete_transportation']);
        // Result 🌠 
        Permission::create(['name' => 'create_result']);
        Permission::create(['name' => 'read_result']);
        Permission::create(['name' => 'update_result']);
        Permission::create(['name' => 'delete_result']);
        // Exam 📁
        Permission::create(['name' => 'create_exam']);
        Permission::create(['name' => 'read_exam']);
        Permission::create(['name' => 'update_exam']);
        Permission::create(['name' => 'delete_exam']);
        // create Roles 🔒 
        Role::create([
            'name' => 'super_admin',
        ]);
        
        Role::create([
            'name' => 'super_manager',
        ])->givePermissionTo([
            'read_user',
            'read_student',
            'read_result',
            'read_school',
            'read_grade',
            'read_classroom',
            'read_result',
            'read_exam',
            'read_discount',
            'read_fee',
            'read_transportation',
        ]);
        
        Role::create([
            'name' => 'finance_manager',
        ])->givePermissionTo([
            'create_user',
            'read_user',
            'update_user',
            'delete_user',
            'create_student',
            'read_student',
            'update_student',
            'delete_student',
            'create_school',
            'read_school',
            'update_school',
            'delete_school',
            'create_grade',
            'read_grade',
            'update_grade',
            'delete_grade',
            'create_classroom',
            'read_classroom',
            'update_classroom',
            'delete_classroom',
            'create_discount',
            'read_discount',
            'update_discount',
            'delete_discount',
            'create_fee',
            'read_fee',
            'update_fee',
            'delete_fee',
            'read_result',
            'read_exam',
            'read_transportation',
        ]);

        Role::create([
            'name' => 'accountant',
        ])->givePermissionTo([
            'create_school',
            'read_school',
            'update_school',
            'create_student',
            'read_student',
            'update_student',
            'create_grade',
            'read_grade',
            'update_grade',
            'create_classroom',
            'read_classroom',
            'update_classroom',
            'create_discount',
            'read_discount',
            'update_discount',
            'read_fee',
        ]);

        Role::create([
            'name' => 'results_manager',
        ])->givePermissionTo([
            'read_school',
            'read_grade',       
            'read_classroom',
            'read_student',
            'create_result',
            'read_result',
            'update_result',
            'delete_result',
            'create_exam',
            'read_exam',
            'update_exam',
            'delete_exam',
        ]);
        
        Role::create([
            'name' => 'results_viewer',
        ])->givePermissionTo([
            'read_school',
            'read_grade',       
            'read_classroom',
            'read_student',
            'read_result',
            'read_exam',
        ]);
        
        Role::create([
            'name' => 'transportation_manager',
        ])->givePermissionTo([
            'read_school',
            'read_grade',       
            'read_classroom',
            'read_student',
            'create_transportation',
            'read_transportation',
            'update_transportation',
            'delete_transportation',
        ]);
    }
}
