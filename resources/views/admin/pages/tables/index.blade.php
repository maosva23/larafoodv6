@extends ('adminlte::page')

@section ('title', 'Mesas')

@section ('content_header')
    <h1>
        Mesas
        <a class="btn btn-dark" href="{{route('tables.create')}}">
            <i class="fas fa-plus-square"></i>
                {{-- ADD --}}
            {{-- </i> --}}
        </a>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashoboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}">Mesas</a></li>
    </ol>
 @stop

@section ('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('tables.search')}}" class="form form-inline" method="POST">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button class="btn btn-dark" type="submit">Filtrar</button>
            </form>
        </div>
        <div class="card-body">

            @include('admin.includes.alerts')

           <table class="table table-light table-condensed">
               <thead class="thead-light">
                   <tr>
                       <th>Mesa</th>
                       <th>Descrição</th>
                       <th width=250>Acções</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($tables as $table)
                        <tr>
                            <td>{{ $table->identify }}</td>
                            <td>{{ $table->description }}</td>
                            <td>
                                <a href="{{route('tables.qrcode', $table->identify)}}" class="btn btn-default" title="QRCode" target="_blank">
                                    <i class="fas fa-qrcode"></i>
{{--                                     VER--}}
                                </a>



                                <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning" title="Ver">
                                    <i class="fas fa-info-circle"></i>
                                    {{-- VER --}}
                                </a>

                                <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info" title="Editar">
                                    <i class="fas fa-edit"></i>
                                    {{-- Editar --}}
                                </a>

                            </td>
                        </tr>

                   @endforeach

               </tbody>
           </table>
        </div>
    </div>
    <div class="card-footer">
        @if(isset($filters))
            {!! $tables->appends($filters)->links() !!}
        @else
            {!! $tables->links() !!}
        @endif

    </div>
 @stop
