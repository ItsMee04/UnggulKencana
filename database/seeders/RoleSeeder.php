<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'admin',
            'kepala',
            'user1',
            'user2',
            'user3'
        ];

        foreach ($data as $value) {
            Role::create([
                'role'      => $value,
                'status'    => 1
            ]);
        }
    }
}
