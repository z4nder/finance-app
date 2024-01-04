<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;

return new class extends Migration {
    public function up(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'),
        ]);
    }

    public function down(): void
    {

    }
};
