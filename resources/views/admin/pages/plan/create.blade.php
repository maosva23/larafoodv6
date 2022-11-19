@extends ('adminlte::page')

@section ('title', 'Cadastrar novo plano')

@section ('content_header')
    <h1>Cadastrar novo plano</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('plans.store')}}" class="form-group" method="POST">
                @csrf

                @include('admin.pages.plan._partials.form')

            </form>
        </div>
        </div>

    <div class="card-footer">
        Rodapé do formulario
    </div>
@stop
