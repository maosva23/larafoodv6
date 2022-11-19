@extends ('adminlte::page')

@section ('title', 'Permissões')

@section ('content_header')
    <h1>
        Permissões
        <a class="btn btn-dark" href="{{route('permissions.create')}}">
            <i class="fas fa-plus-square"></i>
            {{-- ADD --}}
            {{-- </i> --}}
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.index') }}">Permissões</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('permissions.search')}}" class="form form-inline" method="POST">
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
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-sm btn-dark" title="Ver">
                                <i class="fas fa-eye"></i>
                                {{-- VER --}}
                            </a>
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-info" title="Editar">
                                <i class="fas fa-edit"></i>
                                {{-- Editar --}}
                            </a>

{{--                            <a href="{{ route('profiles.permission', $permission->id) }}" class="btn btn-info" title="Perfis">--}}
{{--                                <i class="fas fa-address-book"></i>--}}
{{--                                --}}{{-- Editar --}}
{{--                            </a>--}}
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
