<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        User::create([
            'name' => 'Admin',
            'email' => 'example@example.com',
            'password' => Hash::make('password')
        ]);

        User::factory(2)->create();
        DB::commit();
    }
}
