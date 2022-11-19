@extends ('adminlte::page')

@section ('title', 'Apagar Detalhe')

@section ('content_header')
    <h1>Apagar o Detalhe: <strong>{{$detail->name}}</strong></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashoboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item "><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.show', [$plan->url, $detail->id]) }}">Detalhe</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$detail->name}}
                </li>
            </ul>
        </div>
    </div>

    <div class="card-footer">
        <form action="{{route('details.plan.destroy', [$plan->url, $detail->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="far fa-trash-alt"></i>
                     Apagar o Detalhe {{$detail->name}}
                </button>
            </form>
    </div>
@stop
