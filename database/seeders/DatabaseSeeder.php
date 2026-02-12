<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            [
                'full_name' => 'User 1',
                'email'     => 'example1@mail.net',
            ],
            [
                'full_name' => 'User 2',
                'email'     => 'example2@mail.net',
            ],
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }
    }
}
