@extends ('adminlte::page')

@section ('title', "Editar Permissão: {{ $permission->name }}")

@section ('content_header')
    <h1>Editar Permissão: {{ $permission->name }}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('permissions.update', $permission->id)}}" class="form-group" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.permissions._partials.form')

            </form>
        </div>
    </div>

    <div class="card-footer">
        Rodapé do formulario
    </div>
@stop
