<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;




class HomeController extends Controller
{
    public function index()
    {

        if(Auth::id()){
            $usertype = Auth()->user()->usertype;
            if($usertype == 'Paciente'){
                return view('dashboard');
            } else if($usertype == 'Administrador'){

                $users = User::where('usertype', 'Doctor')->orWhere('usertype', 'Paciente')->get();
                return view('admin.table', compact('users'));

            } else if($usertype == 'Doctor'){
                $users = User::where('usertype', 'Paciente');
                return view('dashboard', compact('users'));

            } else{
                return redirect()->back();
            }
        }

    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['required', 'string', 'max:20'],
            'born' => ['required', 'date', 'max:20'],

        ]);

        $user = User::create([
            'name' => $request->name,
            'born' => $request->born,
            'usertype' => $request->usertype,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));


        return redirect('/home')->with('message', 'Nuevo usuario');
    }

    public function edit($id)
    {
        if(Auth::id()){
                $user = User::find($id);
                return view('admin.edit', compact('user'));
        }
    }

    public function update(ProfileUpdateRequest $request, $id)
    {//TODO
        $data = $request->validated();
        $user = User::where('id', $id)->update([
            'name' => $data['name'],
            'usertype' => $data['usertype'],
            'born' => $data['born'],
            'email' => $data['email'],
        ]);

        return redirect('/home')->with('message', 'Usuario actualizado');
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return redirect('/home')->with('message', 'Usuario eliminado');

    }
}
