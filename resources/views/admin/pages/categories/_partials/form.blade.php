@include('admin.includes.alerts')

<div class="form-group">
    <label for="">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $category->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="">Descriçåo:</label>
    <textarea name="description" cols="30" rows="5" class="form-control" >{{ $category->description ?? old('description')}}</textarea>
</div>

<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>
