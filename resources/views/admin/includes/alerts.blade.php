@if ( $errors->any() )
    <div class="alert alert-warning">
        @foreach ($errors->all() as $error)
            <p>
                {{ $error }}
            </p>
        @endforeach
    </div>
@endif

{{-- Mostra mensagem de alerta ao apagar  --}}
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

{{-- Mostra mensagem de alerta de apagar registo com vinculos  --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Mostra mensagem de alerta de apagar registo com vinculos  --}}
@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif
