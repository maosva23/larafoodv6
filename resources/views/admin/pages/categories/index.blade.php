@extends ('adminlte::page')

@section ('title', 'Categorias')

@section ('content_header')
    <h1>
        Categorias
        <a class="btn btn-dark" href="{{route('categories.create')}}">
            <i class="fas fa-plus-square"></i>
                {{-- ADD --}}
            {{-- </i> --}}
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}">Categorias</a></li>
    </ol>
 @stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('categories.search')}}" class="form form-inline" method="POST">
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
                       <th>Descrição</th>
                       <th width=250 class="text-center">Acções</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td class="text-center">
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-warning" title="Ver">
                                    <i class="fas fa-info-circle"></i>
                                    {{-- VER --}}
                                </a>

                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-dark" title="Editar">
                                    <i class="fas fa-edit"></i>
                                    {{-- Editar --}}
                                </a>

                                <a href="{{ route('products.category', $category->id) }}" class="btn btn-sm btn-dark" title="Produtos">
                                    <i class="fas fa-layer-group"></i>
{{--                                     Produtos--}}
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
            {!! $categories->appends($filters)->links() !!}
        @else
            {!! $categories->links() !!}
        @endif

    </div>
 @stop
