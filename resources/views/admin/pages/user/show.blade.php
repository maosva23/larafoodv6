@extends ('adminlte::page')

@section ('title', "Detalhes do Usuário: {{$user->name}}")

@section ('content_header')
    <h1>Detanhes do Usuário: {{$user->name}}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$user->name}}
                </li>
                <li>
                    <strong>E-mail: </strong> {{$user->email}}
                </li>
                <li>
                    <strong>Empresa: </strong> {{$user->tenant->name}}
                </li>
            </ul>

            @include('admin.includes.alerts')


        </div>

    </div>

    <div class="card-footer">
        <form action="{{route('users.destroy', $user->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
                     Apagar o usuário {{$user->name}}
                </button>
        </form>
    </div>
@stop
