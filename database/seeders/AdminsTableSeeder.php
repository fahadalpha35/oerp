<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRecords = [
            ['id'=>1,'name'=>'Fahad Ahmed','type'=>'superadmin','vendor_id'=>0,'mobile'=>'+8801790004664'
            ,'email'=>'fahadahmedsam@gmail.com','password'=>'$2a$12$wQDRse2Is2TTY0nzuLRnBOkNcQZf7BUoIPz3HVRaU4AP2j/KOXYGq','image'=>'','status'=>1],
        ];
        Admin::insert($adminRecords);
    }
}
