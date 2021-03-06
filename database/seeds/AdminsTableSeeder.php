<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'Fofie Michael',
                'email' => 'fofie.michael@cie.ci',
                'password' => Hash::make('admincie')
            ]
        ]);
    }
}
