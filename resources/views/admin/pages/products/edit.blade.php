@extends ('adminlte::page')

@section ('title', "Editar produto: {{ $product->name }}")

@section ('content_header')
    <h1>Editar produto: {{ $product->name }}</h1>
@stop

@section ('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('products.update', $product->id)}}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.products._partials.form')

            </form>
        </div>
        </div>

    {{-- <div class="card-footer">
        Rodapé do formulario
    </div> --}}
@stop
