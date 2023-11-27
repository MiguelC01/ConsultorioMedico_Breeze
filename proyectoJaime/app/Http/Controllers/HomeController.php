<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id()){
            $usertype = Auth()->user()->usertype;
            if($usertype == 'Paciente'){
                return view('dashboard');
            } else if($usertype == 'Administrador'){
                $users = User::all();
                return view('admin.table', compact('users'));

            } else if($usertype == 'Doctor'){
                $users = User::where('usertype', 'Paciente');
                return view('dashboard', compact('users'));

            } else{
                return redirect()->back();
            }
        }

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
