@include('admin.includes.alerts')

<div class="form-group">
    <label for="">* Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $tenant->name ?? old('name') }}">
</div>

<div class="form-group">
    <label for="">* Logotipo:</label>
    <input type="file" name="logo" class="form-control" >
</div>

<div class="form-group">
    <label for="">* E-mail:</label>
    <input type="email" name="email" class="form-control" placeholder="E-mail:" value="{{ $tenant->email ?? old('email')}}">
</div>

<div class="form-group">
    <label for="">* NIF:</label>
    <input type="text" name="nif" class="form-control" placeholder="NIF:" value="{{ $tenant->nif ?? old('nif')}}">
</div>
<div class="form-group">
    <label>* Activo</label>
    <select class="custom-select form-control" name="active">
        <option value="Y" @if(isset($tenant) && $tenant->active == 'Y') selected @endif>SIM</option>
        <option value="N" @if(isset($tenant) && $tenant->active == 'N') selected @endif>NÃO</option>
    </select>
</div>

<hr>
<h3>Assinatura</h3>
<div class="form-group">
    <label for="">* Data Assinatura (Início):</label>
    <input type="date" name="subscription" class="form-control" placeholder="Data assinatura:" value="{{ $tenant->subscription ?? old('subscription') }}">
</div>
<div class="form-group">
    <label for="">* Expira (Final):</label>
    <input type="date" name="expires_at" class="form-control" placeholder="Expira:" value="{{ $tenant->expires_at ?? old('expires_at') }}">
</div>
<div class="form-group">
    <label for="">* Identificação:</label>
    <input type="text" name="subscription_id" class="form-control" placeholder="Identificação:" value="{{ $tenant->subscription_id ?? old('subscription_id') }}">
</div>

<div class="form-group">
    <label>* Assinatura Activa</label>
    <select class="custom-select form-control" name="subscription_active">
        <option value="1" @if(isset($tenant) && $tenant->subscription_active == '1') selected @endif>SIM</option>
        <option value="0" @if(isset($tenant) && $tenant->subscription_active == '0') selected @endif>NÃO</option>
    </select>
</div>

<div class="form-group">
    <label>* Assinatura Cancelada</label>
    <select class="custom-select form-control" name="subscription_suspended">
        <option value="1" @if(isset($tenant) && $tenant->subscription_suspended == '1') selected @endif>SIM</option>
        <option value="0" @if(isset($tenant) && $tenant->subscription_suspended == '0') selected @endif>NÃO</option>
    </select>
</div>

<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>
