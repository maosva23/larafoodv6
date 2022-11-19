@extends ('adminlte::page')

@section ('title', "Editar plano: {{ $plan->name }}")

@section ('content_header')
    <h1>Editar plano: {{ $plan->name }}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('plans.update', $plan->url)}}" class="form-group" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.plan._partials.form')
                
            </form>
        </div>
        </div>

    <div class="card-footer">
        Rodapé do formulario
    </div>
@stop