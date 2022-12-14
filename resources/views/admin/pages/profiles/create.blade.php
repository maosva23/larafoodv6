@extends ('adminlte::page')

@section ('title', 'Cadastrar novo Perfil')

@section ('content_header')
    <h1>Cadastrar novo Perfil</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('profiles.store')}}" class="form-group" method="POST">

                @include('admin.pages.profiles._partials.form')

            </form>
        </div>
    </div>

    <div class="card-footer">
        Rodapé do formulario
    </div>
@stop
