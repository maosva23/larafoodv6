@extends ('adminlte::page')

@section ('title', "Detalhes da Mesa: {{$table->identify}}")

@section ('content_header')
    <h1>Detanhes da Mesa: {{$table->identify}}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$table->identify}}
                </li>
                <li>
                    <strong>Descriçåo: </strong> {{$table->description}}
                </li>
            </ul>

            @include('admin.includes.alerts')


        </div>

    </div>

    <div class="card-footer">
        <form action="{{route('tables.destroy', $table->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
                     Apagar a mesa: <strong>{{$table->identify}}</strong>
                </button>
        </form>
    </div>
@stop
