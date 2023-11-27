@extends('admin.adminhome')
@section('content')


<a href="{{ route('home')}}">Back</a>

<form method="POST" action="{{ url('home/update'.$user->id) }}">
    @csrf
    @method('PUT')
    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{old('name',$user->name)}}" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="usertype" value="Tipo de usuario" required autofocus autocomplete="usertype"  />
        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="usertype" name="usertype" value="{{old('usertype',$user->usertype)}}">
            <option value="Administrador">Administrador</option>
            <option value="Doctor">Doctor</option>
            <option value="Paciente">Paciente</option>
            </select>
        {{-- <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" /> --}}
        <x-input-error :messages="$errors->get('usertype')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="born" :value="__('Fecha de nacimiento')" />
        <x-text-input id="born" class="block mt-1 w-full" type="date" name="born" value="{{old('born',$user->born)}}" required autofocus autocomplete="born" />
        <x-input-error :messages="$errors->get('born')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Correo')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{old('email',$user->email)}}" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>


    <input type="submit" value="Guardar cambios">
</form>

@endsection
