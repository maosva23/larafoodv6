@include('admin.includes.alerts')

<div class="form-group">
    <label for="">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="">E-mail:</label>
    <input type="email" name="email" class="form-control" placeholder="E-mail:" value="{{ $user->email ?? old('email')}}">
</div>
<div class="form-group">
    <label for="">Password:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha:">
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>
