<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;    // Import DB
use Illuminate\Database\Seeder;

class BusinessTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('business_types')->insert([
            ['id' => 1, 'business_type' => 'Software Company', 'business_status' => 1]     
            // Add the remaining rows similarly
        ]);
    }
}
