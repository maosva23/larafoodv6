@extends ('adminlte::page')

@section ('title', 'Editar Detalhe')

@section ('content_header')
    <h1>Editar o Detalhe: <strong>{{$detail->name}}</strong></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashoboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item "><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}">Editar</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('details.plan.update', [$plan->url, $detail->id])}}" class="form-group" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.plan.details._partials.form')

            </form>
        </div>
    </div>

    <div class="card-footer">
        Rodapé do formulario
    </div>
@stop
