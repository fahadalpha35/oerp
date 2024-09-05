<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;    // Import DB
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'role_name' => 'Super Admin', 'role_status' => 1],
            ['id' => 2, 'role_name' => 'Master Admin', 'role_status' => 1],
            ['id' => 3, 'role_name' => 'Admin', 'role_status' => 1],
            ['id' => 4, 'role_name' => 'Employee', 'role_status' => 1],
            ['id' => 5, 'role_name' => 'Vendor', 'role_status' => 1],
            ['id' => 6, 'role_name' => 'Customer', 'role_status' => 1],
            ['id' => 7, 'role_name' => 'Manufacturer', 'role_status' => 1],
            
            
            // Add the remaining rows similarly
        ]);
    }
}
