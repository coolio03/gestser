<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Attoh Solange',
                'email' => 'attoh.solange@cie.ci',
                'password' => bcrypt('respocie'),
                'role'=>'0',
            ],
            [
                'name' => 'Kouakou Assawa',
                'email' => 'kouakou.assawa@cie.ci',
                'password' => bcrypt('respocie'),
                'role'=>'1',
            ],
            [
                'name' => 'Kone Belle',
                'email' => 'kone.belle@cie.ci',
                'password' => bcrypt('respocie'),
                'role'=>'1',
            ],
            [
                'name' => 'Kone Erica',
                'email' => 'kone.erica@cie.ci',
                'password' => bcrypt('respocie'),
                'role'=>'1',
            ],
            [
                'name' => 'Bah Lucas',
                'email' => 'bah.lucas@cie.ci',
                'password' => bcrypt('respocie'),
                'role'=>'1',
            ],
        ]);
    }
}
