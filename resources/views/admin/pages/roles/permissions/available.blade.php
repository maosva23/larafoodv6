@extends ('adminlte::page')

@section ('title', 'Permissões disponiveis da função')

@section ('content_header')
    <h1>
        Permissões disponiveis da função: <strong>{{ $role->name }}</strong>

    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.roles.create', $role->id) }}">Permissões Disponiveis</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('permissions.roles.create', $role->id)}}" class="form form-inline" method="POST">
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
                <form action="{{ route('permissions.roles.attach', $role->id) }}" method="POST">
                    @csrf

                    @foreach ($permissions as $permission)
                        <tr>
                            <td><input type="checkbox" name="permissions[]" value="{{ $permission->id }}"></td>
                            <td>{{ $permission->name }}</td>
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
            {!! $permissions->appends($filters)->links() !!}
        @else
            {!! $permissions->links() !!}
        @endif

    </div>
@stop
