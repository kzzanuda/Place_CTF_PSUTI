@extends('layouts.main')

@section('content')
<div class="px-5 my-5">
  <h2>Профиль</h2>
  <form>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label">Логин</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $user->name }}">
      </div>
    </div>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $user->email }}">
      </div>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
  </form>
  <br>
  {{ $user->id }}
  <br>
  {{ $userAuth }}
</div>
@endsection
