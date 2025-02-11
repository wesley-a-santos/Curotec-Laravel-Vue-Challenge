<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientEmail;
use App\Models\ClientSocialMedia;
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

        Client::factory()->count(250)
            ->has(ClientEmail::factory()->count(fake()->randomDigitNotNull()), 'emails')
            ->has(ClientSocialMedia::factory()->count(fake()->randomDigitNotNull()), 'socialMedias')
           ->create();
    }
}
