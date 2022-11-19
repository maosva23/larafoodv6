@extends ('adminlte::page')

@section ('title', 'Perfis da Permissão')

@section ('content_header')
    <h1>
        Perfis da Permissão: <strong>{{ $permission->name }}</strong>
        {{-- <a class="btn btn-dark" href="{{route('profiles.profiles.create', $permission->id)}}">
            <i class="fas fa-plus-square"></i>
            ADICIONAR NOVA PERMISSÃO
            </i>
        </a> --}}
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.index') }}">Permissões</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
{{--            <form action="{{route('profiles.search')}}" class="form form-inline" method="POST">--}}
{{--                @csrf--}}
{{--                <div class="form-group">--}}
{{--                    <input class="form-control" type="text" name="filter" placeholder="Nome ou Descricão" value="{{ $filters['filter'] ?? '' }}">--}}
{{--                </div>--}}
{{--                <button class="btn btn-dark" type="submit">Filtrar</button>--}}
{{--            </form>--}}
        </div>
        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-light table-condensed">
                <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th width=190>Acções</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($profiles as $profile)
                    <tr>
                        <td>{{ $profile->name }}</td>
                        <td>
{{--                            <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-warning" title="Ver">--}}
{{--                                <i class="far fa-eye"></i>--}}
{{--                                --}}{{-- VER --}}
{{--                            </a>--}}
                            <a href="{{ route('permissions.profiles.dettach', [$profile->id, $permission->id]) }}" class="btn btn-danger" title="Desvincular">
                                <i class="fas fa-trash"></i>
                                 DESVINCULAR
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
            {!! $profiles->appends($filters)->links() !!}
        @else
            {!! $profiles->links() !!}
        @endif

    </div>
@stop
