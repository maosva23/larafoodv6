@extends ('adminlte::page')

@section ('title', 'Cadastrar novo Permissão')

@section ('content_header')
    <h1>Cadastrar novo Permissão</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('permissions.store')}}" class="form-group" method="POST">

                @include('admin.pages.permissions._partials.form')

            </form>
        </div>
    </div>

    <div class="card-footer">
        Rodapé do formulario
    </div>
@stop
