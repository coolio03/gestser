<?php

namespace App\Http\Controllers\Auth;

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Cadre;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:cadre')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status'=> false,
        ]);
    }

// Admin
    protected function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        Admin::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password']),
        ]);
        return redirect()->intended('login/admin');
    }

//Cadre
    protected function showCadreRegisterForm()
    {
        return view('auth.register', ['url' => 'cadre']);
    }

    protected function createCadre(Request $request)
    {
        $this->validator($request->all())->validate();
        Cadre::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password']),
        ]);
        return redirect()->intended('login/cadre');
    }

    protected function showRegisterForm()
    {
        return view('auth.register');
    }
    
    protected function createUser(Request $request)
    {
        $this->validator($request->all())->validate();
        if($request->type_user == 'Responsable Adm')
        {
            User::create([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
            ]);
        }
        if($request->type_user == 'Admin')
        {
            Admin::create([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
            ]);
        }
        if($request->type_user == 'Cadre')
        {
            Cadre::create([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
            ]);
        }
        return redirect()->intented('admin.comptes.index');
    }
}
