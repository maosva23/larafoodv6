@extends ('adminlte::page')

@section ('title', "Detalhes da Empresa: {{$tenant->name}}")

@section ('content_header')
    <h1>Detalhes da Empresa: {{$tenant->name}}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <ul>
                {{-- <li> --}}
                    <img class="img-fluid" src="{{ url("storage/{$tenant->logo}") }}" alt="{{$tenant->name}}" style="max-width: 90px">
                {{-- </li> --}}
                <li>
                    <strong>Plano: </strong> {{$tenant->plan->name}}
                </li>
                <li>
                    <strong>Nome: </strong> {{$tenant->name}}
                </li>
                <li>
                    <strong>URL: </strong> {{$tenant->url}}
                </li>
                <li>
                    <strong>email: </strong> {{$tenant->email}}
                </li>
                <li>
                    <strong>nif: </strong> {{$tenant->nif}}
                </li>

                <li>
                    <strong>Activo: </strong> {{$tenant->active == 'Y' ? 'SIM': 'NÃO'}}
                </li>
            </ul>

            <hr>

            <ul>
                <h2>Assinatura</h2>
                <li>
                    <strong>Data da assinatura: </strong> {{formatDateAndTime($tenant->subscription, 'd/m/y')}}
                </li>
                <li>
                    <strong>Data de expiração: </strong> {{ formatDateAndTime($tenant->expires_at), 'd/m/y' }}
                </li>
                 <li>
                    <strong>Identificador: </strong> {{$tenant->subscription_id}}
                </li>
                <li>
                    <strong>Activo!: </strong> {{$tenant->subscription_active ? 'SIM': 'NÃO'}}
                </li>
                <li>
                    <strong>Cancelou!: </strong> {{$tenant->subscription_suspended ? 'SIM': 'NÃO'}}
                </li>
            </ul>

            @include('admin.includes.alerts')


        </div>

    </div>

    {{-- <div class="card-footer">
        <form action="{{route('tenants.destroy', $tenant->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
                     Apagar a Empresa: <strong>{{$tenant->name}}</strong>
                </button>
        </form>
    </div> --}}
@stop
