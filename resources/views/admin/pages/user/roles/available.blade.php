@extends ('adminlte::page')

@section ('title', 'Funções disponiveis do Usuário')

@section ('content_header')
    <h1>
        Funções disponiveis do Usuário: <strong>{{ $user->name }}</strong>

    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Usuário</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.users.create', $user->id) }}">Funções Disponiveis</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('roles.users.create', $user->id)}}" class="form form-inline" method="POST">
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
                <form action="{{ route('roles.users.attach', $user->id) }}" method="POST">
                    @csrf

                    @foreach ($roles as $role)
                        <tr>
                            <td><input type="checkbox" name="roles[]" value="{{ $role->id }}"></td>
                            <td>{{ $role->name }}</td>
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
            {!! $roles->appends($filters)->links() !!}
        @else
            {!! $roles->links() !!}
        @endif

    </div>
@stop
