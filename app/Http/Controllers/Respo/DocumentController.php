<?php

namespace App\Http\Controllers\Respo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Models\Collaborateur;
use App\Models\User;
use App\Models\Admin;
use App\Models\Demande;
use app\Models\Cadre;
use app\Models\Document;
use Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['demandes'] = Demande::where('responsable_id',Auth::user()->id)->get();
        return view('respo.documents.index')->with($arr);
    }

    public function attestationStage(Demande $demande)
    {   
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.attestation_stage')->with($arr);
    }
    public function noteStage(Demande $demande)
    {   
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.note_stage')->with($arr);
    }
    public function noteEmbauche(Demande $demande)
    {   
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.note_embauche')->with($arr);
    }
    public function reglementInterieur(Demande $demande)
    {   
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.attribution_ri')->with($arr);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    public function redige(Request $request,Demande $demande,$downloadName = null)
    {
        setlocale(LC_TIME, 'fra_fra');
        $desc = Demande::find($demande->id);   
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/STAGE/ATTESTATION_STAGE.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('niveau', $request->niveau);
        $my_template->setValue('option', $request->option);
        $my_template->setValue('ecole', $request->ecole);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $my_template->setValue('date_fin',strftime('%d %B %Y',strtotime($desc->date_fin)));
        $filename = "Attestation Stage".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
    }
    public function redigeNote(Request $request,Demande $demande,$downloadName = null)
    {
        setlocale(LC_TIME, 'fra_fra');
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/STAGE/Note_de_STAGE.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('destinataire',$request->destinataire);
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('statut', $request->statut);
        $my_template->setValue('niveau', $request->niveau);
        $my_template->setValue('option', $request->option);
        $my_template->setValue('ecole', $request->ecole);
        $my_template->setValue('delai', $request->delai);
        $my_template->setValue('unite', $request->unite);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $my_template->setValue('date_fin',strftime('%d %B %Y',strtotime($desc->date_fin)));
        $my_template->setValue('objet',$request->objet);
        $filename = "Note de Stage".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
    }

    public function redigeNoteEmbauche(Request $request,Demande $demande,$downloadName = null)
    {
        setlocale(LC_TIME, 'fra_fra');
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/EMBAUCHE_A_L_ESSAI/NOTE_EMBAUCHE.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('destinataire',$request->destinataire);
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('matricule', $desc->collaborateur->matricule);
        $my_template->setValue('copie', $request->copie);
        $my_template->setValue('poste', $request->poste);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $my_template->setValue('objet',$request->objet);
        $filename = "Note d'embauche".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
    }

    public function redigeReglementInterieur(Request $request,Demande $demande,$downloadName = null)
    {
        setlocale(LC_TIME, 'fra_fra');
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/EMBAUCHE_A_L_ESSAI/NOTE_EMBAUCHE.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('matricule', $desc->collaborateur->matricule);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $filename = "Lettre attribution RI".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
