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
            ['id'=>1,'name'=>'OSSL','type'=>'superadmin','vendor_id'=>0,'mobile'=>'+8801790004664'
            ,'email'=>'oerp@gmail.com','password'=>'$2y$10$vqXbYdXAgvJRDkhYZHMMze3/zWLEJ6xj/WqfrFrhkEX3T2q5hWLPy','image'=>'','status'=>1],
        ];
        Admin::insert($adminRecords);
    }
}
