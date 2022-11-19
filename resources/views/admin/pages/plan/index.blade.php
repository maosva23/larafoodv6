@extends('adminlte::page')


@section('title', 'Planos')

@section('content_header')
    <h1>
        Planos
        <a class="btn btn-dark" href="{{route('plans.create')}}">
            <i class="fas fa-plus-square"></i>
             ADD
             </i>
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">Planos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('plans.search')}}" class="form form-inline" method="POST">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button class="btn btn-dark" type="submit">Filtrar</button>
            </form>
        </div>
        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-light table-condensed">
                <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th width=270 class="text-center">Acções</th>
                </tr>
                </thead>
                <tbody>
                @foreach($plans as $plan)
                    <tr>
                        <td>{{ $plan->name }}</td>
                        <td> Kz {{ number_format($plan->price, 2, ',', '.')  }}</td>
                        <td class="text-center">
                            <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-sm btn-dark" title="Detalhes">
                                 <i class="far fa-eye"></i>
{{--                                Detalhes--}}
                            </a>

                            <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-sm btn-info" title="Ver">
                                <i class="fas fa-info-circle"></i>
{{--                                 VER--}}
                            </a>
                            <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-sm btn-dark" title="Editar">
                                <i class="fas fa-edit"></i>
{{--                                 Editar--}}
                            </a>

                            <a href="{{ route('profiles.plan', $plan->id) }}" class="btn btn-sm btn-dark" title="Perfis">
                                <i class="fas fa-address-book"></i>
{{--                                 Editar--}}
                            </a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @if(isset($filters))
            {!! $plans->appends($filters)->links() !!}
        @else
            {!! $plans->links() !!}
        @endif

    </div>
@stop
