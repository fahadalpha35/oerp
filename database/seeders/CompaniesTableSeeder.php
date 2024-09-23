<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;    // Import DB
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            ['id' => 1,
            'company_name' => 'Otithee Software Solution Limited',
            'contact_no' => '+8801907802744',
            'trade_license_no' => 'TRAD/DNCC/029335/2023',       
            'company_address' => 'Police Plaza Concord, Tower-A, Floor #8N, 10E, Plot #02, Road #144, Gulshan-1, Dhaka-1212, Bangladesh.',
            'division_id' => 6,
            'district_id' => 47,
            'country' => 'Bangladesh'
            ]     
        ]);
    }
}
