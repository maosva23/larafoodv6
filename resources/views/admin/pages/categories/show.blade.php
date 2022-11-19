@extends ('adminlte::page')

@section ('title', "Detalhes do Categoria: {{$category->name}}")

@section ('content_header')
    <h1>Detanhes do Categoria: {{$category->name}}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$category->name}}
                </li>
                <li>
                    <strong>Nome: </strong> {{$category->url}}
                </li>
                <li>
                    <strong>Descriçåo: </strong> {{$category->description}}
                </li>
            </ul>

            @include('admin.includes.alerts')


        </div>

    </div>

    <div class="card-footer">
        <form action="{{route('categories.destroy', $category->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
                     Apagar a categoria: <strong>{{$category->name}}</strong>
                </button>
        </form>
    </div>
@stop
