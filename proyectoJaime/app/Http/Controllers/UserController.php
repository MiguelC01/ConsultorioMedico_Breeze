<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //$tipoUsuario = Auth::user()->tipoUsuario;
        $tipoUsuario="Administrador";
        switch ($tipoUsuario) {
            case 'Administrador':
                $users = User::all();
                //dd($users);
                return view('admin.home', compact('users'));
                break;

            case 'Doctor':
                $users = User::where('tipoUsuario', 'Paciente');
                return view('doctor.home', compact('users'));
                break;

            default:
                abort(403, 'No tienes permisos para ver esta página.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create($request->all());
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //$tipoUsuario = Auth::user()->tipoUsuario;
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('admin.home')->with('success', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $user)
    {
        $user->delete();
        return redirect(action('UserController@index'));
    }
}
