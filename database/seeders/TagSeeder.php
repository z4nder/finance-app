<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function (User $user) {
            Tag::factory(8)->create([
                'created_by' => $user->id,
            ]);
        });
    }
}
