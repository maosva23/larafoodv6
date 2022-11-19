@extends ('adminlte::page')

@section ('title', "Detalhes do Perfil: {{$profile->name}}")

@section ('content_header')
    <h1>Detalhes do Perfil: {{$profile->name}}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$profile->name}}
                </li>

                <li>
                    <strong>Description: </strong> {{$profile->description}}
                </li>
            </ul>

            @include('admin.includes.alerts')


        </div>

    </div>

    <div class="card-footer">
        <form action="{{route('profiles.destroy', $profile->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
                Apagar o Perfil {{$profile->name}}
            </button>
        </form>
    </div>
@stop
