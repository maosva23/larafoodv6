@extends ('adminlte::page')

@section ('title', 'Cadastrar novo plano')

@section ('content_header')
    <h1>Cadastrar novo Detalhes ao Plano: <strong>{{$plan->name}}</strong></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashoboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item "><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.create', $plan->url) }}">Novo</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('details.plan.store', $plan->url)}}" class="form-group" method="POST">
                @csrf

                @include('admin.pages.plan.details._partials.form')

            </form>
        </div>
    </div>

    <div class="card-footer">
        Rodapé do formulario
    </div>
@stop
