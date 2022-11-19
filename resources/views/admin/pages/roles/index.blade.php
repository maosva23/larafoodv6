@extends ('adminlte::page')

@section ('title', 'Funções')

@section ('content_header')
    <h1>
        Funções
        <a class="btn btn-dark" href="{{route('roles.create')}}">
            <i class="fas fa-plus-square"></i>
            {{-- ADD --}}
            {{-- </i> --}}
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">Funções</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('roles.search')}}" class="form form-inline" method="POST">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="text" name="filter" placeholder="Nome ou Descricão" value="{{ $filters['filter'] ?? '' }}">
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
                    <th width=250 class="text-center">Acções</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-warning" title="Ver">
                                <i class="far fa-eye"></i>
                                {{-- VER --}}
                            </a>

                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-dark" title="Editar">
                                <i class="fas fa-edit"></i>
                                {{-- Editar --}}
                            </a>

                            <a href="{{ route('permissions.role', $role->id) }}" class="btn btn-sm btn-dark" title="Permissões">
                                <i class="fas fa-lock"></i>
{{--                                 Permissões--}}
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
