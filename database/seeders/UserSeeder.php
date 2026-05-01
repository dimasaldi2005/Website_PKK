<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'pkk nganjuk',
            'email' => 'pkknganjuk3005@gmail.com',
            'password' => bcrypt('12345678'),
            'nomer_telepon' => '6281268767765',
            'alamat' => 'Dsn. Gondang, Ds. Tanjung, Kec. Kertosono, Kab. Nganjuk',
        ]);

    }
}
