@extends ('adminlte::page')

@section ('title', 'Cadastrar novo Usuário')

@section ('content_header')
    <h1>Cadastrar novo Usuário</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('users.store')}}" class="form-group" method="POST">
                @csrf

                @include('admin.pages.user._partials.form')

            </form>
        </div>
        </div>

    {{-- <div class="card-footer">
        Rodapé do formulario
    </div> --}}
@stop
