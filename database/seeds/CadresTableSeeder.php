<?php

use Illuminate\Database\Seeder;

class CadresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cadres')->insert([
            [
                'name' => 'Mape MENSAH',
                'email' => 'mape.mensah@cie.ci',
                'password' => Hash::make('cadrecie')
            ]
        ]);
    }
}
