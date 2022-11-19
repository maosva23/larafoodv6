@extends ('adminlte::page')

@section ('title', 'Categorias disponiveis do produto')

@section ('content_header')
    <h1>
        Categorias disponiveis do produto: <strong>{{ $product->name }}</strong>

    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.products.create', $product->id) }}">Categorias Disponiveis</a></li>
    </ol>
@stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('categories.products.create', $product->id)}}" class="form form-inline" method="POST">
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
                <form action="{{ route('categories.products.attach', $product->id) }}" method="POST">
                    @csrf

                    @foreach ($categories as $category)
                        <tr>
                            <td><input type="checkbox" name="categories[]" value="{{ $category->id }}"></td>
                            <td>{{ $category->name }}</td>
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
            {!! $categories->appends($filters)->links() !!}
        @else
            {!! $categories->links() !!}
        @endif

    </div>
@stop
