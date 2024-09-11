<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Partner::factory()->create([
            'name' => 'Acme Inc.',
            'address' => '123 Main St.',
            'email' => 'info@acme.com',
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'hectorsimandev@gmail.com',
            'password' => 'admin',
            'is_admin' => true
        ]);

        // User::factory(10)->create();
    }
}
