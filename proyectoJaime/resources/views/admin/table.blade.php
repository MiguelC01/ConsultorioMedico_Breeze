@extends('admin.adminhome')
@section('content')
<table>
    <tr>
        <th class="p-3">Correo</th>
        <th class="p-3">Nombre</th>
        <th class="p-3">Tipo de usuario</th>
        <th></th>
    </tr>
@foreach ($users as $user)
<tr>
    <td class="p-3">{{$user->email}}</td>
    <td class="p-3">{{$user->name}}</td>
    <td class="p-3">{{$user->usertype}}</td>
    <td class="p-3">
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
