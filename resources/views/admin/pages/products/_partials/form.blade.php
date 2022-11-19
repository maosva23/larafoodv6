@include('admin.includes.alerts')

<div class="form-group">
    <label for="">* Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $product->name ?? old('name') }}">
</div>

<div class="form-group">
    <label for="">* Imagem:</label>
    <input type="file" name="image" class="form-control" >
</div>

<div class="form-group">
    <label for="">Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $product->price ?? old('price')}}">
</div>

<div class="form-group">
    <label for="">* Descriçåo:</label>
    <textarea name="description" cols="30" rows="5" class="form-control" >{{ $product->description ?? old('description')}}</textarea>
</div>

<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>
