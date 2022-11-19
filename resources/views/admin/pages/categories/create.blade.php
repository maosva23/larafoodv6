@extends ('adminlte::page')

@section ('title', 'Cadastrar novo Categoria')

@section ('content_header')
    <h1>Cadastrar novo Categoria</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('categories.store')}}" class="form-group" method="POST">
                @csrf

                @include('admin.pages.categories._partials.form')

            </form>
        </div>
        </div>

    {{-- <div class="card-footer">
        Rodapé do formulario
    </div> --}}
@stop
