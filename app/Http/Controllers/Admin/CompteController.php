<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\Collaborateur;
use App\Models\Admin;
use App\Models\User;
use App\Models\Cadre;
use Illuminate\Support\Facades\Redirect;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['admins'] = Admin::all();
        $arr['users'] = User::all();
        $arr['cadres'] = Cadre::all();
        return view('admin.comptes.liste')->with($arr);
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
    
    public function status(Request $request, $id)
    {
        $data = User::find($id);
        if ($data->status == 0) {
            # code...
            $data->status =1;
        }else{
            $data->status = 0;
        }
        $data->save();
        return redirect()->route('admin.comptes.index')->with('success',$data->name.' Status mis a jour avec succes');
    }
    public function statusCadre(Request $request, $id)
    {
        $data = Cadre::find($id);
        if ($data->role == 0) {
            # code...
            $data->role =1;
        }else{
            $data->role = 0;
        }
        $data->save();
        return redirect()->route('admin.comptes.index')->with('success',$data->name.' Status mis a jour avec succes');
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
