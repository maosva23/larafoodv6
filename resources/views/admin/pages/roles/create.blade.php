@extends ('adminlte::page')

@section ('title', 'Cadastrar nova função')

@section ('content_header')
    <h1>Cadastrar nova função</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('roles.store')}}" class="form-group" method="POST">

                @include('admin.pages.roles._partials.form')

            </form>
        </div>
    </div>

    <div class="card-footer">
        Rodapé do formulario
    </div>
@stop
