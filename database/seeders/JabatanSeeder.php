<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Admin',
            'Kepala',
            'Karyawan'
        ];

        foreach ($data as $value) {
            Jabatan::create([
                'jabatan'   => $value,
                'status'    => 1
            ]);
        }
    }
}
