@extends('admin.adminhome')
@section('content')
<table>
    <tr>
        <th>Correo</th>
        <th>Nombre</th>
        <th>Tipo de usuario</th>
        <th></th>
    </tr>
@foreach ($users as $user)
<tr>
    <td>{{$user->email}}</td>
    <td>{{$user->name}}</td>
    <td>{{$user->usertype}}</td>
    <td>
        <a href="{{url('/profile'.$user->id)}}">Editar</a>
        <form method="POST" action="{{ url('home/delete'.$user->id) }} ">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
            </form>
    </td>
</tr>
@endforeach
</table>
@endsection
