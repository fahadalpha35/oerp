<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;    // Import DB
use Illuminate\Support\Facades\Hash;  // Import Hash

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            // AdminsTableSeeder::class,
            BusinessTypesTableSeeder::class,
            DivisionsTableSeeder::class,
            DistrictsTableSeeder::class,
            RolesTableSeeder::class,
            CompaniesTableSeeder::class,
            // Add more seeder classes as needed
        ]);
        
        DB::table('users')->insert([
            ['id' => 1, 
            'name' => 'OSSL',
            'role_id' => 1,
            'company_id' => 1,
            'email' => 'ossl@gmail.com',
            'password' => Hash::make('12345678'),
            'active_status' => 1,
            'company_business_type' => 1
            ]     

        ]);
    }
}
