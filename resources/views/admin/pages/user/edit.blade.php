@extends ('adminlte::page')

@section ('title', "Editar usuário: {{ $user->name }}")

@section ('content_header')
    <h1>Editar usuário: {{ $user->name }}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('users.update', $user->id)}}" class="form-group" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.user._partials.form')

            </form>
        </div>
        </div>

    {{-- <div class="card-footer">
        Rodapé do formulario
    </div> --}}
@stop
