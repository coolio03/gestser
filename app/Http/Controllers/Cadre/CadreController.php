<?php

namespace App\Http\Controllers\Cadre;

use Illuminate\Http\Request;
use App\Charts\DemandeChart;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\Collaborateur;

use Charts;
use DB;




class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:cadre');
    }
    public function index()
    {

        $traitement = Charts::create('pie', 'highcharts')
            ->title('Traitement des demandes')
            ->labels(['Traitées','Non Traitées'])
            ->values([Demande::whereNotNull('date_traitement')->count(), Demande::whereNull('date_traitement')->count()])
            ->responsive(true);
        $signature = Charts::create('pie', 'highcharts')
            ->title('Signature des demandes')
            ->labels(['Signe','En visa'])
            ->values( [Demande::where('visa', true)->whereNotNull('date_traitement')->count(), Demande::where('visa',false)->whereNotNull('date_traitement')->count()])
            ->responsive(true);
        $cloture = Charts::create('pie', 'highcharts')
            ->title('Cloture des demandes')
            ->labels(['Cloture','Non cloture'])
            ->values([Demande::whereNotNull('date_cloture')->where('visa',true)->count(), Demande::whereNull('date_cloture')->where('visa',true)->count()])
            ->responsive(true);
        $transmission = Charts::create('pie', 'highcharts')
            ->title('Transmission des demandes')
            ->labels(['Transmis','Non Transmis'])
            ->values([ Demande::whereNotNull('date_transmission')->whereNotNull('date_cloture')->count(),Demande::whereNull('date_transmission')->where('visa',true)->count()])
            ->responsive(true);
        $saisie = Charts::create('pie', 'highcharts')
            ->title('Saisie des demandes')
            ->labels(['Saisie','Non Saisie'])
            ->values([Demande::whereNotNull('date_saisir_hr')->whereNotNull('date_cloture')->count(), Demande::whereNull('date_saisir_hr')->where('visa',true)->count()])
            ->responsive(true);   
        $archive = Charts::create('pie', 'highcharts')
            ->title('Archivage des demandes')
            ->labels(['Archives', 'Non Archives'])
            ->values([Demande::whereNotNull('date_archive')->whereNotNull('date_cloture')->count(), Demande::whereNull('date_archive')->where('visa',true)->count()])
            ->responsive(true);
        $complet = Charts::create('pie', 'highcharts')
            ->title('Completude des demandes')
            ->labels(['Complet','Non Complet'])
            ->values([Demande::where('status',true)->count(), Demande::where('status',false)->count()])
            ->responsive(true);
        $ddeRa = Charts::multi('bar', 'highcharts')
            ->title('Demandes par responsables')
            ->labels(['Attoh Solange','kouakou Assawa','Kone Belle','Kone Erica','Bah Lucas'])
            ->dataset('Dossiers Remis',[Demande::where('responsable_id',1)->where('date_remise_ra','!=',null)->count(),Demande::where('responsable_id',2)->where('date_remise_ra','!=',null)->count(),Demande::where('responsable_id',3)->where('date_remise_ra','!=',null)->count(),
            Demande::where('responsable_id',4)->where('date_remise_ra','!=',null)->count(),Demande::where('responsable_id',5)->where('date_remise_ra','!=',null)->count()])
            ->dataset('Dossiers Traites',[Demande::where('responsable_id',1)->where('date_traitement','!=',null)->count(),Demande::where('responsable_id',2)->where('date_traitement','!=',null)->count(),Demande::where('responsable_id',3)->where('date_traitement','!=',null)->count(),
            Demande::where('responsable_id',4)->where('date_traitement','!=',null)->count(),Demande::where('responsable_id',5)->where('date_traitement','!=',null)->count()])
            ->dataset('Dossiers Saisie',[Demande::where('responsable_id',1)->where('date_saisir_hr','!=',null)->count(),Demande::where('responsable_id',2)->where('date_saisir_hr','!=',null)->count(),Demande::where('responsable_id',3)->where('date_saisir_hr','!=',null)->count(),
            Demande::where('responsable_id',4)->where('date_saisir_hr','!=',null)->count(),Demande::where('responsable_id',5)->where('date_saisir_hr','!=',null)->count()])
            ->dimensions(1000,500)
            ->responsive(true)
            ->elementLabel('Nombre de dossiers');
        $arr['demandes'] = Demande::all();
        $arr['collaborateurs'] = Collaborateur::all();
        return view('cadre.index',['traitement'=>$traitement,'signature'=>$signature,'cloture'=>$cloture,'transmission'=>$transmission,'saisie'=>$saisie,
        'archive'=>$archive,'complet'=>$complet,'ddeRa'=>$ddeRa])->with($arr);
    }
}