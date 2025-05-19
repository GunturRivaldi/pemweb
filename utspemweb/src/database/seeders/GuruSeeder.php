<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run()
    {
        
        Guru::truncate();

        
        Guru::create([
            'nama' => 'Ramdani',
            'nip' => '12345678',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jakarta',
            'foto' => 'guru-photos/ramdani.jpg', 
        ]);

        Guru::create([
            'nama' => 'Rafael',
            'nip' => '87654321',
            'jenis_kelamin' => 'L',
            'alamat' => 'Cikande',
            'foto' => 'guru-photos/rafael.jpg',
        ]);

     
    }
}
