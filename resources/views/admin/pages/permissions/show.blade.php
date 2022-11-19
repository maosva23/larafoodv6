@extends ('adminlte::page')

@section ('title', "Detalhes da Permissão: {{$permission->name}}")

@section ('content_header')
    <h1>Detalhes da Permissão: {{$permission->name}}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$permission->name}}
                </li>

                <li>
                    <strong>Description: </strong> {{$permission->description}}
                </li>
            </ul>

            @include('admin.includes.alerts')


        </div>

    </div>

    <div class="card-footer">
        <form action="{{route('permissions.destroy', $permission->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
                Apagar o Perfil: {{$permission->name}}
            </button>
        </form>
    </div>
@stop
