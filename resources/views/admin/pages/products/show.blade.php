@extends ('adminlte::page')

@section ('title', "Detalhes do produto: {{$product->name}}")

@section ('content_header')
    <h1>Detanhes do produto: {{$product->name}}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <img class="img-fluid" src="{{ url("storage/{$product->image}") }}" alt="{{$product->name}}" style="max-width: 90px">
                </li>
                <li>
                    <strong>Nome: </strong> {{$product->name}}
                </li>
                <li>
                    <strong>Flag: </strong> {{$product->flag}}
                </li>
                <li>
                    <strong>Preço: </strong> {{$product->price}}
                </li>
                <li>
                    <strong>Descrição: </strong> {{$product->description}}
                </li>
            </ul>

            @include('admin.includes.alerts')


        </div>

    </div>

    <div class="card-footer">
        <form action="{{route('products.destroy', $product->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
                     Apagar o produto: <strong>{{$product->name}}</strong>
                </button>
        </form>
    </div>
@stop
