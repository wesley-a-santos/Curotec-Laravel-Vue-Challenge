<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        Client::factory()->count(250)->create(['user_id' => 1]);
    }
}
