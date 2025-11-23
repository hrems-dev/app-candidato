<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
            ]
        );

        // Admin con nombre Percy
        Admin::firstOrCreate(
            ['email' => 'percy@example.com'],
            [
                'name' => 'Percy Mamani',
                'password' => Hash::make('percy123'),
            ]
        );
    }
}
