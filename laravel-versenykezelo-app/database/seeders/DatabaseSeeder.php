<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(8)->create();

        User::create([
            'nev' => 'Admin',
            'email' => 'admin@admin.com',
            'telefonszam' => '06301234567',
            'lakcim' => 'Budapest',
            'szuletesi_ev' => '0000',
            'password' => Hash::make('admin'),
        ]);

    }
}
