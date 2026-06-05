<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public const TEACHER_EMAIL = 'teacher@example.com';

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => self::TEACHER_EMAIL],
            [
                'name' => 'Мұғалім',
                'password' => Hash::make('teacher12345'),
                'role' => 'teacher',
            ]
        );
    }
}
