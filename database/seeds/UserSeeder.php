<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default record to konsentrasis table
        DB::table('users')->insert(
            [
                [
                'name' => 'Super Admin',
                'email' => 'superadmin@kedai.or.id',
                'password' => bcrypt('h3110superadmin.,'),
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'name' => 'Admin Extract 1',
                'email' => 'extract01@kedai.or.id',
                'password' => bcrypt('12341234'),
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'name' => 'Admin Extract 2',
                'email' => 'extract02@kedai.or.id',
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now()
                ],
            ]
        );
    }
}
