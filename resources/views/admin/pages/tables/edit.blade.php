@extends ('adminlte::page')

@section ('title', "Editar Mesa: {{ $table->identify }}")

@section ('content_header')
    <h1>Editar Mesa: {{ $table->identify }}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('tables.update', $table->id)}}" class="form-group" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.tables._partials.form')

            </form>
        </div>
        </div>

    {{-- <div class="card-footer">
        Rodapé do formulario
    </div> --}}
@stop
