<?php

namespace App\Http\Controllers\Respo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\Collaborateur;

use Charts;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traitement = Charts::create('pie', 'highcharts')
        ->title('Traitement des demandes')
        ->labels([ 'Traitées','Non Traitées'])
        ->values([Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_traitement')->count() ,Demande::where('responsable_id',Auth::user()->id)->whereNull('date_traitement')->count()])
        ->responsive(true);

        $saisie = Charts::create('pie', 'highcharts')
        ->title('Saisie des demandes dans Hr')
        ->labels([ 'Saisie','Non Saisie'])
        ->values([Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_saisir_hr')->count() ,Demande::where('responsable_id',Auth::user()->id)->whereNull('date_saisir_hr')->count()])
        ->responsive(true);

        $archive = Charts::create('pie', 'highcharts')
        ->title('ARchivage des demandes')
        ->labels([ 'Archive','Non Archive'])
        ->values([Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_archive')->count() ,Demande::where('responsable_id',Auth::user()->id)->whereNull('date_archive')->count()])
        ->responsive(true);

        return view('respo.index',['traitement'=>$traitement, 'saisie'=>$saisie, 'archive'=>$archive]);
    }
    
}
