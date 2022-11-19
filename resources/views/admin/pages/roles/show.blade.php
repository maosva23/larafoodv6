@extends ('adminlte::page')

@section ('title', "Detalhes da Função: {{$role->name}}")

@section ('content_header')
    <h1>Detalhes da Função: {{$role->name}}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$role->name}}
                </li>

                <li>
                    <strong>Description: </strong> {{$role->description}}
                </li>
            </ul>

            @include('admin.includes.alerts')


        </div>

    </div>

    <div class="card-footer">
        <form action="{{route('roles.destroy', $role->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
                Apagar a Função {{$role->name}}
            </button>
        </form>
    </div>
@stop
