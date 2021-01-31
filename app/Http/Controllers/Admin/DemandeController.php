<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\DemandeRequest;
use App\Http\Controllers\Controller;
use Response;
use App\Models\Collaborateur;
use App\Models\User;
use App\Models\Admin;
use App\Models\Demande;
use app\Models\Cadre;
use Exception;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['demandes'] = Demande::latest()->paginate(5);
        $arr['ddeTraites'] = Demande::whereNotNull('date_traitement')->get();
        $arr['users'] = User::all();
        return view('admin.demandes.liste')->with($arr);

    }

    public function affecte()
    {
        $arr['demandes'] = Demande::whereNotNull('responsable_id')->latest()->paginate(5);
        $arr['users'] = User::all();
        return view('admin.demandes.affecte')->with($arr);

    }
    public function complet()
    {
        $arr['demandes'] = Demande::where('status','=',true)->latest()->paginate(5);
        return view('admin.demandes.complet')->with($arr);

    }
    public function nonComplet()
    {
        $arr['demandes'] = Demande::where('status','=',false)->latest()->paginate(5);
        return view('admin.demandes.complet')->with($arr);

    }


    public function traite()
    {
        $arr['demandes'] = Demande::whereNotNull('date_traitement')->latest()->paginate(5);
        $arr['users'] = User::all();
        return view('admin.demandes.traite')->with($arr);

    }

    public function nonTraite()
    {
        $arr['demandes'] = Demande::whereNull('date_traitement')->latest()->paginate(5);
        $arr['users'] = User::all();
        return view('admin.demandes.non_traite')->with($arr);

    }

    public function cloture()
    {
        $arr['demandes'] = Demande::whereNotNull('date_cloture')->where('visa',true)->latest()->paginate(5);
        $arr['users'] = User::all();
        return view('admin.demandes.cloture')->with($arr);
    }

    public function nonCloture()
    {
        $arr['demandes'] = Demande::whereNull('date_cloture')->where('visa',true)->latest()->paginate(5);
        $arr['users'] = User::all();
        return view('admin.demandes.cloture')->with($arr);
    }

    public function transmisClient()
    {
        $arr['demandes'] = Demande::whereNotNull('date_transmission')->where('visa',true)->latest()->paginate(5);
        $arr['users'] = User::all();
        return view('admin.demandes.transmission')->with($arr);
    }
    public function nonTransmisClient()
    {
        $arr['demandes'] = Demande::whereNull('date_transmission')->where('visa',true)->latest()->paginate(5);
        return view('admin.demandes.transmission')->with($arr);
    }
    public function saisieHr()
    {
        $arr['demandes'] = Demande::whereNotNull('date_saisir_hr')->where('visa',true)->latest()->paginate(5);
        $arr['users'] = User::all();
        return view('admin.demandes.saisieHr')->with($arr);
    }
    public function nonSaisieHr()
    {
        $arr['demandes'] = Demande::whereNull('date_saisir_hr')->where('visa',true)->latest()->paginate(5);
        $arr['users'] = User::all();
        return view('admin.demandes.saisieHr')->with($arr);
    }


    public function nonAffecte()
    {
        $arr['demandes'] = Demande::whereNull('responsable_id')->latest()->paginate(5);
        $arr['users'] = User::all();
        return view('admin.demandes.non_affecte')->with($arr);
    }

    public function visa()
    {
        $arr['demandes'] = Demande::where('visa',False)->whereNotNull('date_traitement')->latest()->paginate(5);
        return view('admin.demandes.visa')->with($arr);

    }
    public function signe()
    {
        $arr['demandes'] = Demande::where('visa',True)->latest()->paginate(5);
        return view('admin.demandes.visa')->with($arr);

    }
    public function nonArchive()
    {
        $arr['demandes'] = Demande::whereNull('date_archive')->where('visa',true)->latest()->paginate(5);
        return view('admin.demandes.archive')->with($arr);

    }

    public function detail($id)
    {   
        $arr['collabo'] = Collaborateur::with('demande')->findOrFail($id);
        return view('admin.collaborateurs.detail')->with($arr);
    }

    public function detailVisa($id)
    {   
        $arr['demande'] = Demande::findOrFail($id);
        return view('admin.demandes.detail')->with($arr);
    }

    public function suivreSigne($id)
    {   
        $arr['demande'] = Demande::findOrFail($id);
        return view('admin.demandes.suivre_signe')->with($arr);
    }

    public function detailDemande($id)
    {
        $arr['demande'] = Demande::findOrFail($id);
        return view('admin.demandes.suivie')->with($arr);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['collaborateurs'] = Collaborateur::all();
        $arr['users'] = User::all();
        return view('admin.demandes.ajoute')->with($arr)->with('succes','Demandes creer avec succes');
    }


    public function affectation(Demande $demande)
    {
        $arr['demande'] = $demande;
        $arr['collaborateurs'] = Collaborateur::all();
        $arr['users']=User::all();
        return view('admin.demandes.affectation')->with($arr)->with('success','Demande affectee avec succes!!!');
    }

    public function affecter(Request $request, Demande $demande)
    {       
        $demande->responsable_id = $request->responsable_id;       
        $demande->update();
        return redirect()->route('admin.demandes.index');
    }

    //Permet la mise a jour du suivie des demande
    public function suivre1(Request $request)
    {
       $demande = Demande::findOrFail($request->id);
       $demande->update($request->all());
       return back();
    }

    public function suivre(Request $request, Demande $demande)
    {
        $demande = Demande::findOrFail($demande->id);
     
        if ($demande->type == "STAGE ECOLE") {
            $demande->visa =  !empty($demande->date_visa_sdap) ? true : false ;
        } elseif ($demande->type == "STAGE QUALIFICATION" OR $demande->type == "STAGE IMMERSION") {
            $demande->visa =  !empty($demande->date_visa_darh) ? true : false ;
        }elseif ($demande->type == "PROROGATION") {
            $demande->visa =  !empty($demande->date_visa_sg) ? true : false ;     
        } else {
            $demande->visa =  !empty($demande->date_visa_dg) ? true : false ;
        }
        if (!empty($demande->date_traitement) AND !empty($demande->date_cloture) AND !empty($demande->date_transmission) AND !empty($demande->date_saisir_hr) AND !empty($demande->date_archive)) {
                $demande->status = true;
        } else {
                $demande->status = false;
        }
       $demande->update($request->all());
       return back();
    }


  public function mise_a_jour()
    {
        
            //
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DemandeRequest $request, Demande $demande)
    {    
        $collabo = Collaborateur::where('matricule', $request->matricule)->value('id');
        $demande->collaborateur_id = Collaborateur::where('matricule', $request->matricule)->value('id');
        if ($request->type!="EMBAUCHE A L ESSAI") {
            $demande->numero_dossier = 'SER'.'_'.date('Y').'_'.substr($request->type,0,4).'_'.date('His');
            
        }else {
            $demande->numero_dossier = 'SER'.'_'.date('Y').'_ESSAI_'.date('His');

        }
        $demande->cadre_id = $request->cadre_id;
        $demande->responsable_id = $request->responsable_id;
        $demande->type = $request->type;
        $demande->motif_demande = $request->motif_demande;
        $demande->direction = $request->direction;
        $demande->date_debut = $request->date_debut;
        $demande->date_fin = $request->date_fin;
        $demande->date_reception = $request->date_reception;
        $demande->save();
        return redirect()->route('admin.demandes.index')->with('success','Demande creer avec succes!!!!');
        
        
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
    public function edit(Demande $demande)
    {
        $arr['demande'] = $demande;
        $arr['users'] = User::all();
        return view('admin.demandes.modifie')->with($arr);
    }
    public function redige(Demande $demande, $downloadName = null)
    {
        setlocale(LC_TIME, 'fra_fra');
        $desc = Demande::find($demande->id);
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/STAGE/ATTESTATION STAGE.docx'));
        $my_template->setValue('emetteur',strtoupper($desc->user->name) );
        $my_template->setValue('civilite', 'Monsieur');
        $my_template->setValue('date_redige', strftime('%d %B %Y'));
        $my_template->setValue('nom', $desc->collaborateur->nom.' '.$desc->collaborateur->prenom);
        $my_template->setValue('niveau', 'MASTER 2');
        $my_template->setValue('option', 'GENIE INFORMATIQUE');
        $my_template->setValue('ecole', 'UNIVERSITE NANGUI ABROGOUA');
        $my_template->setValue('date_debut', strftime('%d %B %Y'));
        $my_template->setValue('date_fin', strftime('%d %B %Y'));
        $filename = "Attestation_Stage". $desc->collaborateur->nom;
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
    public function update(Request $request, Demande $demande)
    {
        $collabo = Collaborateur::where('matricule', $request->matricule)->value('id');
        $demande->collaborateur_id = Collaborateur::where('matricule', $request->matricule)->value('id');
            if ($request->type!="EMBAUCHE A L ESSAI") {
                $demande->numero_dossier = 'SER'.'_'.date('Y').'_'.substr($request->type,0,4).'_'.date('His');
                
            }else {
                $demande->numero_dossier = 'SER'.'_'.date('Y').'_ESSAI_'.date('His');

            }
            $demande->cadre_id = $request->cadre_id;
            $demande->responsable_id = $request->responsable_id;
            $demande->type = $request->type;
            $demande->motif_demande = $request->motif_demande;
            $demande->date_debut = $request->date_debut;
            $demande->date_fin = $request->date_fin;
            $demande->direction = $request->direction;
            $demande->date_reception = $request->date_reception;
        
            $demande->update();
            return redirect()->route('admin.demandes.index')->with('success','Demande mise a jour avec succes!!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Demande::destroy($id);
        return redirect()->route('admin.demandes.index')->with('success','Demande Supprimer avec succes!!!!');
    }
}
