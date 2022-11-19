@extends ('adminlte::page')

@section ('title', 'Usuários')

@section ('content_header')
    <h1>
        Usuários
        <a class="btn btn-dark" href="{{route('users.create')}}">
            <i class="fas fa-plus-square"></i>
                {{-- ADD --}}
            {{-- </i> --}}
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Usuários</a></li>
    </ol>
 @stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('users.search')}}" class="form form-inline" method="POST">
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
                       <th>E-mail</th>
                       <th width=250 class="text-center">Acções</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-warning" title="Ver">
                                    <i class="fas fa-info-circle"></i>
                                    {{-- VER --}}
                                </a>

                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-dark" title="Editar">
                                    <i class="fas fa-edit"></i>
                                    {{-- Editar --}}
                                </a>

                                <a href="{{ route('roles.user', $user->id) }}" class="btn btn-sm btn-dark" title="Cargos">
                                    <i class="fas fa-user-tag"></i>
                                     Cargos na Empresa
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
            {!! $users->appends($filters)->links() !!}
        @else
            {!! $users->links() !!}
        @endif

    </div>
 @stop
