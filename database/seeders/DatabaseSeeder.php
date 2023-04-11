<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            ->hasLinks(5)
            ->create();
            
        User::factory()->create();

        User::factory()->create([
            'role' => 'admin'
        ]);
    }
}
