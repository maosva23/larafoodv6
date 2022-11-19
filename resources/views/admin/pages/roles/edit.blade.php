@extends ('adminlte::page')

@section ('title', "Editar Função: {{ $role->name }}")

@section ('content_header')
    <h1>Editar Função: {{ $role->name }}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('roles.update', $role->id)}}" class="form-group" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.roles._partials.form')

            </form>
        </div>
    </div>

    <div class="card-footer">
        Rodapé do formulario
    </div>
@stop
