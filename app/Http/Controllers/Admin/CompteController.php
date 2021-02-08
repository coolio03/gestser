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
     * 
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    protected function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status'=> false,
        ]);
    }
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
        return view('admin.comptes.ajoute');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        if($request->type_user == 'Responsable Adm')
        {
            User::createUser([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
            ]);
        }
        if($request->type_user == 'Admin')
        {
            Admin::createUser([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
            ]);
        }
        if($request->type_user == 'Cadre')
        {
            Cadre::createUser([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
            ]);
        }

        return redirect()->intented('admin.comptes.index');
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
