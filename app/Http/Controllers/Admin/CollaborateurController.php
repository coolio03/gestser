<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CollaborateurRequest;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Collaborateur;
use App\Models\User;
use App\Models\Admin;
use App\Models\Demande;

class CollaborateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['collaborateurs'] = Collaborateur::paginate(5);
        return view('admin.collaborateurs.liste')->with($arr);
    }

    public function detail($id)
    {
        $arr['demandes'] = Demande::where('collaborateur_id',$id)->first();
        return view('admin.collaborateurs.detail')->with($arr);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.collaborateurs.ajoute');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollaborateurRequest $request, Collaborateur $collaborateur)
    {
       /* $rule = [
            'matricule' => 'bail|required|unique:collaborateurs|max:7|alpha_num',
            'nom' => 'bail|required|max:50|string',
            'prenoms' => 'bail|required|max:25|string',
            'date_de_naissance' => 'bail|required',
            'lieu_de_naissance' => 'bail|required|string',
            'ancienne_fonction' =>'required',
            'nouvelle_fonction' =>'required',
            'categorie' => 'required',
            'contact' => 'required',
        ];
        $customMessages=[
            'unique' => 'Ce matricule existe deja dans la base de donnees',
            'required' => 'Ce champs est obligatoire',
        ];*/

      /* $request->validate(
           [
            'matricule' => 'bail|required|unique:collaborateurs|max:7|alpha_num',
            'nom' => 'required|max:50|string',
            'prenoms' => 'required|max:25|string',
            'date_de_naissance' => 'required',
            'lieu_de_naissance' => 'required|string',
            'ancienne_fonction' =>'required',
            'nouvelle_fonction' =>'required',
            'categorie' => 'required',
            'contact' => 'required',
        ],
        [
            'matricule'=>'Matricule existant dans la base de donnee'
        ]);*/
        $collaborateur->cadre_id= $request->cadre_id;
        $collaborateur->matricule = $request->matricule;
        $collaborateur->civilite = $request->civilite;
        $collaborateur->nom = $request->nom;
        $collaborateur->prenoms = $request->prenoms;
        $collaborateur->numero_identite = $request->numero_identite;
        $collaborateur->numero_cnps = $request->numero_cnps;
        $collaborateur->date_de_naissance = $request->date_de_naissance;
        $collaborateur->lieu_de_naissance = $request->lieu_de_naissance;
        $collaborateur->ancienne_fonction = $request->ancienne_fonction;
        $collaborateur->nouvelle_fonction = $request->nouvelle_fonction;
        $collaborateur->categorie = $request->categorie;
        $collaborateur->contact = $request->contact;

        $collaborateur->save();
        
        return redirect()->route('admin.collaborateurs.index');

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
    public function edit(Collaborateur $collaborateur)
    {
        $arr['collaborateur'] = $collaborateur;
        return view('admin.collaborateurs.modifie')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collaborateur $collaborateur)
    {
       /* $collaborateur->cadre_id= $request->cadre_id;
        $collaborateur->matricule = $request->matricule;
        $collaborateur->nom = $request->nom;
        $collaborateur->prenoms = $request->prenoms;
        $collaborateur->date_de_naissance = $request->date_de_naissance;
        $collaborateur->lieu_de_naissance = $request->lieu_de_naissance;
        $collaborateur->ancienne_fonction = $request->ancienne_fonction;
        $collaborateur->nouvelle_fonction = $request->nouvelle_fonction;
        $collaborateur->categorie = $request->categorie;
        $collaborateur->contact = $request->contact;*/
        $collaborateur->update($request->all());
        return redirect()->route('admin.collaborateurs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Collaborateur::destroy($id);
        Demande::where('collaborateur_id',$id)->delete();
        return redirect()->route('admin.collaborateurs.index')->with('success','Collaborateur supprimer avec succes');
    }
    public function delete($id)
{
    $collaborateur = Collaborateur::find($id);

    return view('admin.collaborateurs.delete', compact('collaborateur'));
}
}
