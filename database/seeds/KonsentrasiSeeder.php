<?php

use Illuminate\Database\Seeder;

class KonsentrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default record to konsentrasis table
        DB::table('konsentrasis')->insert(
            [
                [
                'nama' => 'Belum Ada',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Program',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Network Engineering',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Multimedia',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Hardware',
                'created_at' => now(),
                'updated_at' => now()
                ],
            ]
        );
    }
}
