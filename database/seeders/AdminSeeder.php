<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name'     => 'Admin RY Travel',
            'email'    => 'admin@rytravel.com',
            'password' => Hash::make('admin123'),
        ];

        if (Schema::hasColumn('users', 'role')) {
            $data['role'] = 'admin';
        }

        User::create($data);

        $this->command->info('Akun Admin berhasil dibuat!');
        $this->command->info('Email: admin@rytravel.com');
        $this->command->info('Password: admin123');
    }
}

