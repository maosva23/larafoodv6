@extends ('adminlte::page')

@section ('title', 'Perfis disponiveis do Plano')

@section ('content_header')
    <h1>
        Perfis disponiveis do Plano: <strong>{{ $plan->name }}</strong>

    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.plan.create', $plan->id) }}">Perfis Disponiveis</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('profiles.plan.create', $plan->id)}}" class="form form-inline" method="POST">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="text" name="filter" placeholder="Nome ou Descricão" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button class="btn btn-dark" type="submit">Filtrar</button>
            </form>
        </div>
        <div class="card-body">

            <table class="table table-light table-condensed">
                <thead class="thead-light">
                <tr>
                    <th width="50px">#</th>
                    <th>Nome</th>

                </tr>
                </thead>
                <tbody>
                <form action="{{ route('profiles.plan.attach', $plan->id) }}" method="POST">
                    @csrf

                    @foreach ($profiles as $profile)
                        <tr>
                            <td><input type="checkbox" name="profiles[]" value="{{ $profile->id }}"></td>
                            <td>{{ $profile->name }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        @include('admin.includes.alerts')

                        <td colspan="500">
                            <button type="submit"class="btn btn-success">VINCULAR</button>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @if(isset($filters))
            {!! $profiles->appends($filters)->links() !!}
        @else
            {!! $profiles->links() !!}
        @endif

    </div>
@stop
