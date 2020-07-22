<?php

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
        $this->call(AgendaSeeder::class); //seed tabel agenda
        $this->call(KonsentrasiSeeder::class); //seed tabel konsentrasi
        $this->call(UserSeeder::class); //seed tabel user
    }
}
