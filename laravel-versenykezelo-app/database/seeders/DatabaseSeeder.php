<?php

namespace Database\Seeders;


use App\Models\Competition;
use App\Models\Participant;
use App\Models\Round;
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
        // Eslő user a teszt user
        User ::create([
            'nev' => 'Teszt Felhasználó',
            'email' => 'testuser@email.com',
            'telefonszam' => '06301234567',
            'lakcim' => 'Budapest',
            'szuletesi_ev' => '0000',
            'password' => Hash::make('testuser'),
        ]);
        // Dummy users
         User::factory(7)->create();

        User::create([
            'nev' => 'Admin',
            'email' => 'admin@admin.com',
            'telefonszam' => '06301234567',
            'lakcim' => 'Budapest',
            'szuletesi_ev' => '0000',
            'password' => Hash::make('admin'),
        ]);


        // Dummy verseny
        Competition::create([
            'nev' => 'Tesztverseny',
            'ev' => 2021,
            'elerheto_nyelvek' => 'magyar, angol',
            'pontok_jo' => 1,
            'pontok_rossz' => 0,
            'pontok_ures' => 0,
        ]);
        // Dummy forduló a tesztversenyhez
        Round::create([
            'verseny_id' => 1,
            'nev' => 'Teszt forduló',
            'datum' => '2021-05-01',
        ]);

        // Felhasználó hozzáadása a fordulóhoz (participant create)
         Participant::create([
            'felhasznalo_id' => 1,
            'fordulo_id' => 1,
        ]);

    }
}
