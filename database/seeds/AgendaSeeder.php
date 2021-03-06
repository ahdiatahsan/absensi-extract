<?php

use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default record to agendas table
        DB::table('agendas')->insert(
            [
                [
                'nama' => 'Pembelajaran Program',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Pembelajaran Network Engineering',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Pembelajaran Multimedia',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Pembelajaran Hardware',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Pembelajaran System Administrator',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Keorganisasian',
                'created_at' => now(),
                'updated_at' => now()
                ],
            ]
        );
    }
}
