@include('admin.includes.alerts')

<div class="form-group">
    <label for="">Identificação da Mesa:</label>
    <input type="text" name="identify" class="form-control" placeholder="Identificação da Mesa:" value="{{ $table->identify ?? old('identify') }}">
</div>
<div class="form-group">
    <label for="">Descriçåo:</label>
    <textarea name="description" cols="30" rows="5" class="form-control" >{{ $table->description ?? old('description')}}</textarea>
</div>

<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>
