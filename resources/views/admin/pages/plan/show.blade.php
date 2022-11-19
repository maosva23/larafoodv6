@extends ('adminlte::page')

@section ('title', "Detalhes do plano: {{$plan->name}}")

@section ('content_header')
    <h1>Detanhes do plano: {{$plan->name}}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$plan->name}}
                </li>
                <li>
                    <strong>URL: </strong> {{$plan->url}}
                </li>
                <li>
                    <strong>Preço: </strong> Kz {{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Description: </strong> {{$plan->description}}
                </li>
            </ul>

            @include('admin.includes.alerts')

            
        </div>
        
    </div>

    <div class="card-footer">
        <form action="{{route('plans.destroy', $plan->url)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
                     Apagar o Plano {{$plan->name}}
                </button>
        </form>
    </div>
@stop
