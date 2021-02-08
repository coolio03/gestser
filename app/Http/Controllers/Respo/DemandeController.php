<?php

namespace App\Http\Controllers\Respo;


use Illuminate\Http\Request;
use App\Http\Requests\DemandeRequest;
use App\Http\Controllers\Controller;
use Response;
use App\Models\Collaborateur;
use App\Models\User;
use App\Models\Admin;
use App\Models\Demande;
use app\Models\Cadre;
use Auth;
class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['demandes'] = Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_remise_ra')->latest()->paginate(5);
        return view('respo.demandes.liste')->with($arr);
    }

    public function traite()
    {
        $arr['demandes'] = Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_traitement')->whereNotNull('date_remise_ra')->latest()->paginate(5);
        return view('respo.demandes.traite')->with($arr);
    }

    public function nonTraite()
    {
        $arr['demandes'] = Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_remise_ra')->whereNull('date_traitement')->latest()->paginate(5);
        return view('respo.demandes.liste')->with($arr);
    }

    public function saisirHr()
    {
        $arr['demandes'] = Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_traitement')->whereNotNull('date_remise_ra')->whereNotNull('date_saisir_hr')->latest()->paginate(5);
        return view('respo.demandes.liste')->with($arr);
    }

    public function nonSaisirHr()
    {
        $arr['demandes'] = Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_traitement')->whereNotNull('date_remise_ra')->whereNull('date_saisir_hr')->latest()->paginate(5);
        return view('respo.demandes.liste')->with($arr);
    }
    
    public function nonArchive()
    {
        $arr['demandes'] = Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_traitement')->whereNotNull('date_remise_ra')->whereNull('date_archive')->latest()->paginate(5);
        return view('respo.demandes.liste')->with($arr);
    }
    public function archive()
    {
        $arr['demandes'] = Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_traitement')->whereNotNull('date_remise_ra')->whereNotNull('date_archive')->latest()->paginate(5);
        return view('respo.demandes.liste')->with($arr);
    }
    public function signalTraiter($id)
    {
        $arr['demande'] = Demande::findOrFail($id);
        return view('respo.demandes.signal_traiter')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
   

    public function traiter(Request $request, Demande $demande)
    {
       $demande->date_traitement = $request->date_traitement;
       $demande->update();
       return back();
    }


    public function suivieSaisie(Request $request, Demande $demande)
    {
        $demande = Demande::findOrFail($demande->id);
        $demande->update($request->all());
        return back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function document(Demande $demande)
    {
        $arr['demande']=$demande;
        return view('respo.documents.index')->with($arr);
    }

    public function redige(Request $request,Demande $demande, $downloadName = null)
    {
        
        setlocale(LC_TIME, 'fra_fra');
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path("app/public/STAGE/ATTESTATION STAGE.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y',strtotime($request->date_redaction)));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', $request->civilite);
        $my_template->setValue('nom', $request->nom.' '.$request->prenoms);
        $my_template->setValue('niveau', $request->niveau);
        $my_template->setValue('option', $request->option);
        $my_template->setValue('ecole', $request->ecole);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($request->date_debut)));
        $my_template->setValue('date_fin',strftime('%d %B %Y',strtotime($request->date_fin)));
        $filename = "Attestation Stage".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(storage_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
    
       
        return response()->download(storage_path("$filename.docx"));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,Demande $demande, $downloadName = null)
    {
        setlocale(LC_TIME, 'fra_fra');
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path("app/public/ATTESTATION_STAGE.docx"));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', $request->civilite);
        $my_template->setValue('date_redige', strftime('%d %B %Y'));
        $my_template->setValue('nom', $request->nom.' '.$request->prenoms);
        $my_template->setValue('niveau', $request->niveau);
        $my_template->setValue('option', $request->option);
        $my_template->setValue('ecole', $request->ecole);
        $my_template->setValue('date_debut', strftime('%d %B %Y'));
        $my_template->setValue('date_fin', strftime('%d %B %Y'));
        $filename = "Attestation_Stage".' '.$desc->collaborateur->nom;
        try{
            $my_template->saveAs(storage_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
    
        return response()->download(storage_path("$filename.docx"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
