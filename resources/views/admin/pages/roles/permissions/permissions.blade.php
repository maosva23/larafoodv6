@extends ('adminlte::page')

@section ('title', 'Permissões da função')

@section ('content_header')
    <h1>
        Permissões da função: <strong>{{ $role->name }}</strong>
        <a class="btn btn-dark" href="{{route('permissions.roles.create', $role->id)}}">
            <i class="fas fa-plus-square"></i>
            ADICIONAR NOVA PERMISSÃO
            {{-- </i> --}}
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">Funções</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
{{--            <form action="{{route('permissions.search')}}" class="form form-inline" method="POST">--}}
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
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
{{--                            <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning" title="Ver">--}}
{{--                                <i class="far fa-eye"></i>--}}
{{--                                --}}{{-- VER --}}
{{--                            </a>--}}
                            <a href="{{ route('permissions.roles.dettach', [$role->id, $permission->id]) }}" class="btn btn-sm btn-danger" title="Editar">
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
            {!! $permissions->appends($filters)->links() !!}
        @else
            {!! $permissions->links() !!}
        @endif

    </div>
@stop
