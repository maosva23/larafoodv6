@extends ('adminlte::page')

@section ('title', 'Empresas')

@section ('content_header')
    <h1>
        Empresas
        {{-- <a class="btn btn-dark" href="{{route('tenants.create')}}">
            <i class="fas fa-plus-square"></i>
                ADD
            </i>
        </a> --}}
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.index') }}">Empresas</a></li>
    </ol>
 @stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('tenants.search')}}" class="form form-inline" method="POST">
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
                       <th>Imagem</th>
                       <th>Nome</th>
                       {{-- <th>Descrição</th> --}}
                       <th width=180>Acções</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($tenants as $tenant)
                        <tr>
                            <td><img class="img-fluid" src="{{ url("storage/{$tenant->logo}") }}" alt="{{$tenant->name}}" style="max-width: 50px"></td>
                            <td>{{ $tenant->name }}</td>
                            {{-- <td>{{ $tenant->description }}</td> --}}
                            <td>
                                <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-warning" title="Ver">
                                    <i class="fas fa-info-circle"></i>
                                    {{-- VER --}}
                                </a>

                                <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-info" title="Editar">
                                    <i class="fas fa-edit"></i>
                                    {{-- Editar --}}
                                </a>

                                {{-- <a href="{{ route('categories.tenant', $tenant->id) }}" class="btn btn-dark" title="Categorias">
                                    <i class="fas fa-layer-group"></i>
                                    Editar
                                </a> --}}

                            </td>
                        </tr>

                   @endforeach

               </tbody>
           </table>
        </div>
    </div>
    <div class="card-footer">
        @if(isset($filters))
            {!! $tenants->appends($filters)->links() !!}
        @else
            {!! $tenants->links() !!}
        @endif

    </div>
 @stop
