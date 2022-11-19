@extends ('adminlte::page')

@section ('title', 'Produtos da Categoria')

@section ('content_header')
    <h1>
        Produtos da Categoria: <strong>{{ $category->name }}</strong>
        {{-- <a class="btn btn-dark" href="{{route('products.products.create', $permission->id)}}">
            <i class="fas fa-plus-square"></i>
            ADICIONAR NOVA CATEGORIA
            </i>
        </a> --}}
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}">Categorias</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
{{--            <form action="{{route('products.search')}}" class="form form-inline" method="POST">--}}
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
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th width=190>Acções</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><img class="img-fluid" src="{{ url("storage/{$product->image}") }}" alt="{{$product->name}}" style="max-width: 50px"></td>
                        <td>{{ $product->name }}</td>
                        <td>
{{--                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning" title="Ver">--}}
{{--                                <i class="far fa-eye"></i>--}}
{{--                                --}}{{-- VER --}}
{{--                            </a>--}}
                            <a href="{{ route('categories.products.dettach', [$product->id, $category->id]) }}" class="btn btn-danger" title="Desvincular">
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
            {!! $products->appends($filters)->links() !!}
        @else
            {!! $products->links() !!}
        @endif

    </div>
@stop
