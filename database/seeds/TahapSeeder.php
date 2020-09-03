<?php

use Illuminate\Database\Seeder;

class TahapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default record to tahaps table
        DB::table('tahaps')->insert(
            [
                [
                'nama' => 'Tahap 1',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Tahap 2',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Tahap 3',
                'created_at' => now(),
                'updated_at' => now()
                ],
            ]
        );
    }
}
