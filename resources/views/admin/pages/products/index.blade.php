@extends ('adminlte::page')

@section ('title', 'Produtos')

@section ('content_header')
    <h1>
        Produtos
        <a class="btn btn-dark" href="{{route('products.create')}}">
            <i class="fas fa-plus-square"></i>
                {{-- ADD --}}
            {{-- </i> --}}
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Produtos</a></li>
    </ol>
 @stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('products.search')}}" class="form form-inline" method="POST">
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
                       <th width=180 class="text-center">Acções</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($products as $product)
                        <tr>
                            <td><img class="img-fluid" src="{{ url("storage/{$product->image}") }}" alt="{{$product->name}}" style="max-width: 50px"></td>
                            <td>{{ $product->name }}</td>
                            {{-- <td>{{ $product->description }}</td> --}}
                            <td class="text-center">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-warning" title="Ver">
                                    <i class="fas fa-info-circle"></i>
                                    {{-- VER --}}
                                </a>

                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-dark" title="Editar">
                                    <i class="fas fa-edit"></i>
                                    {{-- Editar --}}
                                </a>

                                <a href="{{ route('categories.product', $product->id) }}" class="btn btn-sm btn-dark" title="Categorias">
                                    <i class="fas fa-layer-group"></i>
{{--                                     Categorias--}}
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
            {!! $products->appends($filters)->links() !!}
        @else
            {!! $products->links() !!}
        @endif

    </div>
 @stop
