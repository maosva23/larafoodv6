@extends ('adminlte::page')

@section ('title', 'Categorias do Produto')

@section ('content_header')
    <h1>
        Categorias do Produto: <strong>{{ $product->name }}</strong>
        <a class="btn btn-dark" href="{{route('categories.products.create', $product->id)}}">
            <i class="fas fa-plus-square"></i>
            ADICIONAR NOVA CATEGORIA
            {{-- </i> --}}
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Produto</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
{{--            <form action="{{route('categories.search')}}" class="form form-inline" method="POST">--}}
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
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
{{--                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-warning" title="Ver">--}}
{{--                                <i class="far fa-eye"></i>--}}
{{--                                --}}{{-- VER --}}
{{--                            </a>--}}
                            <a href="{{ route('categories.products.dettach', [$product->id, $category->id]) }}" class="btn btn-danger" title="Editar">
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
            {!! $categories->appends($filters)->links() !!}
        @else
            {!! $categories->links() !!}
        @endif

    </div>
@stop
