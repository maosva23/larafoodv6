@extends ('adminlte::page')

@section ('title', "Detalhes do plano {$plan->name}")

@section ('content_header')
    <h1>
        Detalhes do plano <strong>{{ $plan->name }}</strong>
        <a class="btn btn-dark" href="{{route('details.plan.create', $plan->url)}}">
            <i class="fas fa-plus-square"></i>
                {{-- ADD --}}
            {{-- </i> --}}
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashoboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
    </ol>
 @stop

@section ('content')
    <div class="card">
        {{-- <div class="card-header">
            <form action="{{route('plans.search')}}" class="form form-inline" method="POST">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button class="btn btn-dark" type="submit">Filtrar</button>
            </form>
        </div> --}}
        <div class="card-body">

            @include('admin.includes.alerts')

           <table class="table table-light table-condensed">
               <thead class="thead-light">
                   <tr>
                       <th>Nome</th>
                       <th width=150>Acções</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($details as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td>
                                <a href="{{ route('details.plan.show', [$plan->url, $detail->id]) }}" class="btn btn-warning" title="Ver">
                                    <i class="fas fa-info-circle"></i>
                                    {{-- VER --}}
                                </a>
                                <a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}" class="btn btn-info" title="Editar">
                                    <i class="fas fa-edit"></i>
                                    {{-- Editar --}}
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
            {!! $details->appends($filters)->links() !!}
        @else
            {!! $details->links() !!}
        @endif

    </div>
 @stop
