@extends ('adminlte::page')

@section ('title', 'Funções do Usuário')

@section ('content_header')
    <h1>
        Funções do Usuário: <strong>{{ $user->name }}</strong>
        <a class="btn btn-dark" href="{{route('roles.users.create', $user->id)}}">
            <i class="fas fa-plus-square"></i>
            ADICIONAR NOVA FUNÇÃO
            {{-- </i> --}}
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Usuário</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
{{--            <form action="{{route('roles.search')}}" class="form form-inline" method="POST">--}}
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
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
{{--                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning" title="Ver">--}}
{{--                                <i class="far fa-eye"></i>--}}
{{--                                --}}{{-- VER --}}
{{--                            </a>--}}
                            <a href="{{ route('roles.users.dettach', [$user->id, $role->id]) }}" class="btn btn-danger" title="Editar">
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
            {!! $roles->appends($filters)->links() !!}
        @else
            {!! $roles->links() !!}
        @endif

    </div>
@stop
