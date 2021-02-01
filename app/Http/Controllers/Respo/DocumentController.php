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
        $arr['demandes'] = Demande::where('responsable_id',Auth::user()->id)->whereNotNull('date_remise_ra')->get();
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

    public function contratEmbauche(Demande $demande)
    {
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.embauche_essai')->with($arr);
    }

    public function contratCDI(Demande $demande)
    {
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.contrat_cdi')->with($arr);
    }

    public function renouvellementEmbEssai(Demande $demande)
    {
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.renouvellement_emb_essai')->with($arr);
    }

    public function titularisation(Demande $demande)
    {
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.titularisation')->with($arr);
    }
    public function avisTitularisation(Demande $demande)
    {
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.avis_titularisation')->with($arr);
    }
    public function contratCDD(Demande $demande)
    {
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.contrat_cdd')->with($arr);
    }
    public function finContratCDD(Demande $demande)
    {
        $arr['demande'] = Demande::findOrFail($demande->id);
        return view('respo.documents.fin_contrat_cdd')->with($arr);
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
        date_default_timezone_set('Africa/Abidjan');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
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
        $filename = "DCRH IS 71 18 01 ATTESTATION STAGE".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
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
        setlocale(LC_ALL, "fr_FR.UTF-8");
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
        $filename = "DCRH IS 71 16 01 Note de STAGE".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
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
        setlocale(LC_ALL, "fr_FR.UTF-8");
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
        $filename = "DCRH IS 71 25 01 NOTE D'INFO EMBAUCHE EO M".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
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
        setlocale(LC_ALL, "fr_FR.UTF-8");
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/EMBAUCHE_A_L_ESSAI/FICHE_ATTRIBUTION_Attribution_Règlement_Intérieur.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('matricule', $desc->collaborateur->matricule);
        $my_template->setValue('direction_sc', $request->direction_sc);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $filename = "DCRH IS 71 22 01 FICHE D'ATTRIBUTION RI".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
    }

    public function redigeRenouvellementEmbEssai(Request $request,Demande $demande,$downloadName = null)
    {
        setlocale(LC_ALL, "fr_FR.UTF-8");
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/EMBAUCHE_A_L_ESSAI/LETTRE_DE_RENOUVELLEMENT_PERIODE_ESSAI.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('matricule', $desc->collaborateur->matricule);
        $my_template->setValue('direction_sc', $request->direction_sc);
        $my_template->setValue('copie', $request->copie);
        $my_template->setValue('poste', $request->poste);
        $my_template->setValue('delai', $request->delai);
        $my_template->setValue('unite', $request->unite);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $my_template->setValue('date_fin',strftime('%d %B %Y',strtotime($desc->date_fin)));
        $filename = "DCRH IS 71 21 01 LETTRE DE RENOUVELLEMENT PERIODE D'ESSAI".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
    }

    public function redigeContratEmbauche(Request $request,Demande $demande,$downloadName = null)
    {
 
        setlocale(LC_ALL, "fr_FR.UTF-8");
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/EMBAUCHE_A_L_ESSAI/CONTRAT_EMBAUCHE_A_ESSAI.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('direction_sc', strtoupper($request->direction_sc));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('matricule', $desc->collaborateur->matricule);
        $my_template->setValue('delai', $request->delai);
        $my_template->setValue('unite', $request->unite);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $my_template->setValue('date_fin',strftime('%d %B %Y',strtotime($desc->date_fin)));
        $my_template->setValue('direction_acceuil',$request->direction_acceuil);
        $my_template->setValue('service_acceuil',$request->service_acceuil);
        $my_template->setValue('fonction',$request->fonction);
        $my_template->setValue('classement',$request->classement);
        $my_template->setValue('salaire_mensuelle',$request->salaire_mensuelle);
        $my_template->setValue('prime_logement',$request->prime_logement);
        $my_template->setValue('prime_entretien',$request->prime_entretien);
        $filename = "DCRH IS 71 04 01 EMBAUCHE A ESSAI".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
    }

    public function redigeContratCDI(Request $request,Demande $demande,$downloadName = null)
    {
        
        setlocale(LC_ALL, "fr_FR.UTF-8");
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/CDI/Contrat_CDI.docx"));
        $my_template->setValue('date_redaction',date('d/m/Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('direction_sc', strtoupper($request->direction_sc));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('date_de_naissance', date('d/m/Y',strtotime($desc->collaborateur->date_de_naissance)));
        $my_template->setValue('lieu_de_naissance', strtoupper($desc->collaborateur->lieu_de_naissance));
        $my_template->setValue('nom_pere', strtoupper($request->nom_pere));
        $my_template->setValue('nom_mere', strtoupper($request->nom_mere));
        $my_template->setValue('situation_familiale', $request->situation_familiale);
        $my_template->setValue('adresse_actuelle', strtoupper($request->lieu_habitation));
        $my_template->setValue('profession', strtoupper($request->profession));
        $my_template->setValue('matricule', $desc->collaborateur->matricule);
        $my_template->setValue('fonction', $request->fonction);
        $my_template->setValue('direction_acceuil',$request->direction_acceuil);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $my_template->setValue('fonction',$request->fonction);
        $my_template->setValue('nationnalite',$request->nationnalite);
        $my_template->setValue('classement',$request->classement);
        $my_template->setValue('categorie',$desc->collaborateur->categorie);
        $my_template->setValue('echellon',$request->echellon);
        $my_template->setValue('salaire_mensuelle',$request->salaire_mensuelle);
        $my_template->setValue('prime_logement',$request->prime_logement);
        $my_template->setValue('prime_transport',$request->prime_transport);
        $my_template->setValue('ind_tranche_grat',$request->ind_tranche_grat);
        $filename = "DCRH IS 71 01 02 Contrat CDI".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
    }

    public function redigeContratCDD(Request $request,Demande $demande,$downloadName = null)
    {
        
        setlocale(LC_ALL, "fr_FR.UTF-8");
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/CDD/CONTRAT_CDD.docx"));
        $my_template->setValue('date_redaction',date('d/m/Y'));
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('date_de_naissance', date('d/m/Y',strtotime($desc->collaborateur->date_de_naissance)));
        $my_template->setValue('lieu_de_naissance', strtoupper($desc->collaborateur->lieu_de_naissance));
        $my_template->setValue('nom_pere', strtoupper($request->nom_pere));
        $my_template->setValue('nom_mere', strtoupper($request->nom_mere));
        $my_template->setValue('numero_identite', strtoupper($desc->collaborateur->numero_identite));
        $my_template->setValue('numero_cnps', strtoupper($desc->collaborateur->numero_cnps));
        $my_template->setValue('situation_matrimoniale', $request->situation_familiale);
        $my_template->setValue('lieu_habitation', strtoupper($request->lieu_habitation));
        $my_template->setValue('profession', strtoupper($request->profession));
        $my_template->setValue('matricule', $desc->collaborateur->matricule);
        $my_template->setValue('fonction', $request->fonction);
        $my_template->setValue('direction_acceuil',$request->direction_acceuil);
        $my_template->setValue('chef_service',$request->chef_service);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $my_template->setValue('date_fin',strftime('%d %B %Y',strtotime($desc->date_fin)));
        $my_template->setValue('fonction',$request->fonction);
        $my_template->setValue('nationnalite',$request->nationnalite);
        $my_template->setValue('categorie',$desc->collaborateur->categorie);
        $my_template->setValue('echellon',$request->echellon);
        $my_template->setValue('salaire_mensuelle',$request->salaire_mensuelle);
        $my_template->setValue('prime_transport',$request->prime_transport);
        $filename = "DCRH IS 71 09 02 CONTRAT CDD".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
    }

    public function redigeTitularisation(Request $request,Demande $demande,$downloadName = null)
    {
        setlocale(LC_ALL, "fr_FR.UTF-8");
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/CDI/TITULARISATION.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('matricule', $desc->collaborateur->matricule);
        $my_template->setValue('direction_sc', $request->direction_sc);
        $my_template->setValue('copie', $request->copie);
        $my_template->setValue('poste', $request->poste);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $filename = "DCRH IS 71 06 01 TITULARTISATION".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
    }

    public function redigeFinContratCDD(Request $request,Demande $demande,$downloadName = null)
    {
        setlocale(LC_ALL, "fr_FR.UTF-8");
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/CDD/LETTRE_DE_FIN_DE_CDD.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('matricule', $desc->collaborateur->matricule);
        $my_template->setValue('direction_sc', $request->direction_sc);
        $my_template->setValue('destinataire', $request->destinataire);
        $my_template->setValue('fonction', $request->fonction);
        $my_template->setValue('direction_acceuil', $request->direction_acceuil);
        $my_template->setValue('copie', $request->copie);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $my_template->setValue('date_fin',strftime('%d %B %Y',strtotime($desc->date_fin)));
        $filename = "DCRH IS 71 10 01 LETTRE DE FIN DE CDD".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
        try{
            $my_template->saveAs(public_path("$filename.docx"));
        }catch (Exception $e){
           dd($e);
        }
        $downloadName = $downloadName??$filename;
       
       
        return response()->download(public_path("$filename.docx"));
        
    }

    public function redigeAvisTitularisation(Request $request,Demande $demande,$downloadName = null)
    {
        setlocale(LC_ALL, "fr_FR.UTF-8");
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("Documents/CDI/AVIS_TITULARISATION.docx"));
        $my_template->setValue('date_redaction',strftime('%d %B %Y'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', ucfirst($desc->collaborateur->civilite));
        $my_template->setValue('initial', implode('',array_map(function($p){return strtoupper($p[0]);},explode(' ',$desc->user->name))));
        $my_template->setValue('nom', strtoupper($desc->collaborateur->nom));
        $my_template->setValue('prenoms', strtoupper($desc->collaborateur->prenoms));
        $my_template->setValue('matricule', $desc->collaborateur->matricule);
        $my_template->setValue('direction', $request->direction);
        $my_template->setValue('destinataire', $request->destinataire);
        $my_template->setValue('copie', $request->copie);
        $my_template->setValue('classement_actuel', $request->classement_actuel);
        $my_template->setValue('fonction', $request->fonction);
        $my_template->setValue('code_expl', $request->code_expl);
        $my_template->setValue('date_debut',strftime('%d %B %Y',strtotime($desc->date_debut)));
        $my_template->setValue('date_fin_essai',strftime('%d %B %Y',strtotime($request->date_fin_essaie)));
        $filename = "DCRH IS 71 05 01 AVIS DE TITULARTISATION".' '.$desc->collaborateur->nom.' '.$desc->collaborateur->prenoms;
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
