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
                'civilite'=>'Monsieur',
                'matricule' => '061771D',
                'nom' => 'COULIBALY',
                'prenoms' => 'ADAMA',
                'date_de_naissance' => '1900-05-01',
                'lieu_de_naissance' => 'ABOBO / ABIDJAN',
                'numero_identite' => 'ATT01010101010',
                'numero_cnps' => 'cnps0101010',
                'ancienne_fonction' => 'STAGIAIRE',
                'nouvelle_fonction' => 'STAGIAIRE',
                'categorie' => 'CADRE',
                'contact' => '78845245',
            ],
            [
                'cadre_id' => 1,
                'civilite'=>'Monsieur',
                'matricule' => '071871D',
                'nom' => 'BAN',
                'prenoms' => 'KOUATO CYRILLE',
                'date_de_naissance' => '1996-05-03',
                'lieu_de_naissance' => 'ABOBO / ABIDJAN',
                'numero_identite' => 'ATT01010101010',
                'numero_cnps' => 'cnps0101010',
                'ancienne_fonction' => 'DISPATCHER',
                'nouvelle_fonction' => 'DISPATCHER',
                'categorie' => 'EO',
                'contact' => '78845245',
            ],
            [
                'cadre_id' => 1,
                'civilite' => 'Madame',
                'matricule' => '082771D',
                'nom' => 'MARIAM',
                'prenoms' => 'BAMBA EPSE COULIBALY',
                'date_de_naissance' => '1900-05-01',
                'lieu_de_naissance' => 'DALOA',
                'numero_identite' => 'ATT01010101010',
                'numero_cnps' => 'cnps0101010',
                'ancienne_fonction' => 'CONSEILLERE',
                'nouvelle_fonction' => 'CONSEILLERE',
                'categorie' => 'M',
                'contact' => '78845245',
            ],
            [
                'cadre_id' => 1,
                'civilite'=>'Monsieur',
                'matricule' => '059571D',
                'nom' => 'BILE',
                'prenoms' => 'PACOME',
                'date_de_naissance' => '1900-05-01',
                'lieu_de_naissance' => 'GUGLO',
                'numero_identite' => 'ATT01010101010',
                'numero_cnps' => 'cnps0101010',
                'ancienne_fonction' => 'COMPTABLE',
                'nouvelle_fonction' => 'COMPTABLE',
                'categorie' => 'CADRE',
                'contact' => '78845245',
            ],
            [
                'cadre_id' => 1,
                'civilite'=>'Mademoiselle',
                'matricule' => '043571D',
                'nom' => 'DIANE',
                'prenoms' => 'DOBE',
                'date_de_naissance' => '1900-05-01',
                'lieu_de_naissance' => 'DIVO',
                'numero_identite' => 'ATT01010101010',
                'numero_cnps' => 'cnps0101010',
                'ancienne_fonction' => 'AGENT TECHNIQUE HYDROLIQUE',
                'nouvelle_fonction' => 'RESPONSABLE BARRAGE',
                'categorie' => 'CADRE',
                'contact' => '78845245',
            ],

        ]);

    }
}
