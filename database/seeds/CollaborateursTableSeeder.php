<?php

use Illuminate\Database\Seeder;

class CollaborateursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collaborateurs')->insert([
            [
                'cadre_id' => 1,
                'matricule' => '061771D',
                'nom' => 'COULIBALY',
                'civilite'=>'Monsieur',
                'prenoms' => 'ADAMA',
                'date_de_naissance' => '1900-05-01',
                'lieu_de_naissance' => 'ABOBO / ABIDJAN',
                'ancienne_fonction' => 'STAGIAIRE',
                'nouvelle_fonction' => 'STAGIAIRE',
                'categorie' => 'CADRE',
                'contact' => '78845245',
            ],
            [
                'cadre_id' => 1,
                'matricule' => '071871D',
                'nom' => 'BAN',
                'civilite'=>'Monsieur',
                'prenoms' => 'KOUATO CYRILLE',
                'date_de_naissance' => '1996-05-03',
                'lieu_de_naissance' => 'ABOBO / ABIDJAN',
                'ancienne_fonction' => 'DISPATCHER',
                'nouvelle_fonction' => 'DISPATCHER',
                'categorie' => 'EO',
                'contact' => '78845245',
            ],
            [
                'cadre_id' => 1,
                'matricule' => '082771D',
                'nom' => 'MARIAM',
                'civilite'=>'Madame',
                'prenoms' => 'BAMBA EPSE COULIBALY',
                'date_de_naissance' => '1900-05-01',
                'lieu_de_naissance' => 'DALOA',
                'ancienne_fonction' => 'CONSEILLERE',
                'nouvelle_fonction' => 'CONSEILLERE',
                'categorie' => 'M',
                'contact' => '78845245',
            ],
            [
                'cadre_id' => 1,
                'matricule' => '059571D',
                'nom' => 'BILE',
                'civilite'=>'Monsieur',
                'prenoms' => 'PACOME',
                'date_de_naissance' => '1900-05-01',
                'lieu_de_naissance' => 'GUGLO',
                'ancienne_fonction' => 'COMPTABLE',
                'nouvelle_fonction' => 'COMPTABLE',
                'categorie' => 'CADRE',
                'contact' => '78845245',
            ],
            [
                'cadre_id' => 1,
                'matricule' => '043571D',
                'nom' => 'DIANE',
                'civilite'=>'Mademoiselle',
                'prenoms' => 'DOBE',
                'date_de_naissance' => '1900-05-01',
                'lieu_de_naissance' => 'DIVO',
                'ancienne_fonction' => 'AGENT TECHNIQUE HYDROLIQUE',
                'nouvelle_fonction' => 'RESPONSABLE BARRAGE',
                'categorie' => 'CADRE',
                'contact' => '78845245',
            ],

        ]);

    }
}
