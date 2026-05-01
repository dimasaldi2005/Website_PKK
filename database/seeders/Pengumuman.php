<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('pengumumans')->insert([
            'imagePengumuman' => 'candra.png',
            'judulPengumuman' => 'candra',
            'deskripsiPengumuman' => 'candra akwokawoa',
        ]);
    }
}
