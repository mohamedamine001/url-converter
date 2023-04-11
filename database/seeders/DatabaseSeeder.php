<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Link;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)
            ->hasLinks(3)
            ->create();

        User::factory()->create([
            'email' => 'admin@test.com',
            'role' => 'admin',
        ]);
    }
}
