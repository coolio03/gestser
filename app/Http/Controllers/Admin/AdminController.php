<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth:admin');
    }
    public function index()
    {

/*
        $borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            "rgba(255, 99, 132, 0.2)",
            "rgba(22,160,133, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(51,105,232, 0.2)",
            "rgba(244,67,54, 0.2)",
            "rgba(34,198,246, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"

        ];
        $ddesTraitesChart = new DemandeChart;
        $ddesSignesChart = new DemandeChart;
        $ddesCloturesChart = new DemandeChart;
        $ddestransmisesChart = new DemandeChart;
        $ddesSaisirChart = new DemandeChart;
        $ddesArchiveChart = new DemandeChart;
        $ddesCompletChart = new DemandeChart;
        $ddesRaChart = new DemandeChart;
        //Traite
        $ddesTraitesChart->minimalist(true);
        $ddesTraitesChart->displaylegend(true);
        $ddesTraitesChart->title('Traitement des demandes ');
        $ddesTraitesChart->labels(['Non Traitées', 'Traitées']);
        $ddesTraitesChart->dataset('Traitement', 'doughnut', [Demande::whereNull('date_traitement')->count(),Demande::whereNotNull('date_traitement')->count() ])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
            
        //Signes
        $ddesSignesChart->minimalist(true);
        $ddesSignesChart->displaylegend(true);
        $ddesSignesChart->title('Circuit de signature');
        $ddesSignesChart->labels(['En Visa', 'Signées']);
        $ddesSignesChart->dataset('Visa', 'pie', [Demande::where('visa',false)->whereNotNull('date_traitement')->count(), Demande::where('visa', true)->whereNotNull('date_traitement')->count()])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        

        //Clotures
        $ddesCloturesChart->minimalist(true);
        $ddesCloturesChart->displaylegend(true);
        $ddesCloturesChart->title('Cloture des demandes');
        $ddesCloturesChart->labels(['Non Cloturées', 'Cloturées']);
        $ddesCloturesChart->dataset('Cloture', 'pie', [Demande::whereNull('date_cloture')->where('visa',true)->count(), Demande::whereNotNull('date_cloture')->where('visa',true)->count()])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        //Remis au client
        $ddestransmisesChart->minimalist(true);
        $ddestransmisesChart->displaylegend(true);
        $ddestransmisesChart->title('Transmission aux client');
        $ddestransmisesChart->labels(['Transmission aux client', 'Transmis']);
        $ddestransmisesChart->dataset('Nombre de dossiers', 'pie', [Demande::whereNull('date_transmission')->whereNotNull('date_cloture')->count(), Demande::whereNotNull('date_transmission')->whereNotNull('date_cloture')->count()])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        //Saisir dans Hr
        $ddesSaisirChart->minimalist(true);
        $ddesSaisirChart->displaylegend(true);
        $ddesSaisirChart->title('Saisir dans Hra');
        $ddesSaisirChart->labels([ 'Pas encore saisie','Saisie dans Hr','Pas necessaire']);
        $ddesSaisirChart->dataset('Nombre de dossiers', 'pie', [Demande::whereNull('date_saisir_hr')->whereNotNull('date_cloture')->count(), Demande::whereNotNull('date_saisir_hr')->whereNotNull('date_cloture')->count()])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        //Archive
        $ddesArchiveChart->minimalist(true);
        $ddesArchiveChart->displaylegend(true);
        $ddesArchiveChart->title('Demandes Archivé');
        $ddesArchiveChart->labels(['Non Archivé', 'Archivé']);
        $ddesArchiveChart->dataset('Nombre de dossiers', 'pie', [Demande::whereNull('date_archive')->whereNotNull('date_cloture')->count(), Demande::whereNotNull('date_archive')->whereNotNull('date_cloture')->count()])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        //complet
        $ddesCompletChart->minimalist(true);
        $ddesCompletChart->displaylegend(true);
        $ddesCompletChart->title('Demandes completes');
        $ddesCompletChart->labels(['Non Complet', 'Complet']);
        $ddesCompletChart->dataset('Nombre de dossiers', 'pie', [Demande::where('status',false)->count(), Demande::where('status',true)->count()])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $ddesRaChart->minimalist(true);
        $ddesRaChart->displaylegend(true);
        $ddesRaChart->title('Demandes par responsable Admin');
        $ddesRaChart->labels(['Attoh Solange','kouakou Assawa','Kone Belle','Kone Erica','Bah Lucas']);
        $ddesRaChart->dataset('Nombre de dossier','bar',[Demande::where('responsable_id',1)->count(),Demande::where('responsable_id',2)->count(),Demande::where('responsable_id',3)->count(),Demande::where('responsable_id',4)->count(),Demande::where('responsable_id',5)->count()])
        ->color($borderColors)
        ->backgroundcolor($fillColors);

        

        $arr['demandes'] = Demande::all();
        $arr['collaborateurs'] = Collaborateur::all();
        return view('admin.index', [ 'ddesTraitesChart' => $ddesTraitesChart, 'ddesSignesChart' => $ddesSignesChart,
        'ddesCloturesChart' => $ddesCloturesChart, 'ddestransmisesChart'=>$ddestransmisesChart, 
        'ddesSaisirChart'=>$ddesSaisirChart, 'ddesArchiveChart' => $ddesArchiveChart, 'ddesCompletChart' => $ddesCompletChart,
        'ddesRaChart'=>$ddesRaChart])->with($arr);

    }*/
    $traitement = Charts::create('pie', 'highcharts')
        ->title('Traitement des demandes')
        ->labels(['Non Traitées', 'Traitées'])
        ->values([Demande::whereNull('date_traitement')->count(),Demande::whereNotNull('date_traitement')->count() ])
        ->responsive(true);
    $signature = Charts::create('pie', 'highcharts')
        ->title('Signature des demandes')
        ->labels(['En visa', 'Signe'])
        ->values( [Demande::where('visa',false)->whereNotNull('date_traitement')->count(), Demande::where('visa', true)->whereNotNull('date_traitement')->count()])
        ->responsive(true);
    $cloture = Charts::create('pie', 'highcharts')
        ->title('Cloture des demandes')
        ->labels(['Non cloture', 'Cloture'])
        ->values([Demande::whereNull('date_cloture')->where('visa',true)->count(), Demande::whereNotNull('date_cloture')->where('visa',true)->count()])
        ->responsive(true);
     $transmission = Charts::create('pie', 'highcharts')
        ->title('Transmission des demandes')
        ->labels(['Non Transmis', 'Transmis'])
        ->values([Demande::whereNull('date_transmission')->whereNotNull('date_cloture')->count(), Demande::whereNotNull('date_transmission')->whereNotNull('date_cloture')->count()])
        ->responsive(true);
    $saisie = Charts::create('pie', 'highcharts')
        ->title('Saisie des demandes')
        ->labels(['Non Saisie', 'Saisie'])
        ->values([Demande::whereNull('date_saisir_hr')->whereNotNull('date_cloture')->count(), Demande::whereNotNull('date_saisir_hr')->whereNotNull('date_cloture')->count()])
        ->responsive(true);   
    $archive = Charts::create('pie', 'highcharts')
        ->title('Archivage des demandes')
        ->labels(['Non Archives', 'Archives'])
        ->values([Demande::whereNull('date_archive')->whereNotNull('date_cloture')->count(), Demande::whereNotNull('date_archive')->whereNotNull('date_cloture')->count()])
        ->responsive(true);
    $complet = Charts::create('pie', 'highcharts')
        ->title('Completude des demandes')
        ->labels(['Non Complet', 'Complet'])
        ->values([Demande::where('status',false)->count(), Demande::where('status',true)->count()])
        ->responsive(true);
    $ddeRa = Charts::create('bar', 'highcharts')
        ->title('Demandes par responsables')
        ->labels(['Attoh Solange','kouakou Assawa','Kone Belle','Kone Erica','Bah Lucas'])
        ->values([Demande::where('responsable_id',1)->where('date_traitement','!=',null)->count(),Demande::where('responsable_id',2)->where('date_traitement','!=',null)->count(),Demande::where('responsable_id',3)->where('date_traitement','!=',null)->count(),
        Demande::where('responsable_id',4)->where('date_traitement','!=',null)->count(),Demande::where('responsable_id',5)->where('date_traitement','!=',null)->count()])
        ->dimensions(1000,500)
        ->elementLabel('Nombre de dossiers')
        ->responsive(true);
    $arr['demandes'] = Demande::all();
    $arr['collaborateurs'] = Collaborateur::all();
    return view('admin.index',['traitement'=>$traitement,'signature'=>$signature,'cloture'=>$cloture,'transmission'=>$transmission,'saisie'=>$saisie,
    'archive'=>$archive,'complet'=>$complet,'ddeRa'=>$ddeRa])->with($arr);
}
}