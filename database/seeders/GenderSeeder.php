<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            ['id' => 1, 'name' => 'Female'],
            ['id' => 2, 'name' => 'Male'],
            ['id' => 3, 'name' => 'Others'],
        ];

        foreach ($genders as $gender) {
            $newGender = new Gender();
            $newGender->name = $gender['name'];
            $newGender->save();
        }
    }
}
