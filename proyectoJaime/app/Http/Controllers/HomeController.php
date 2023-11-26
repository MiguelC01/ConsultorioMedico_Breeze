<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
                return view('admin.adminhome', compact('users'));

            } else if($usertype == 'Doctor'){
                $users = User::where('usertype', 'Paciente');
                return view('dashboard', compact('users'));

            } else{
                return redirect()->back();
            }
        }

    }
}
