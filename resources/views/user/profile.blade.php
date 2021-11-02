@extends('layouts.main')

@section('content')
<div class="px-5 my-5 container">
  <h2>Профиль</h2>
  @if(Auth::user()->id == $user->id)
  <form>
    <div class="form-group row">
      <label for="staticFio" class="col-sm-2 col-form-label">ФИО</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="staticFio" value="{{ $user->name }}">
      </div>
      <label for="staticEmail" class="col-sm-2 col-form-label mt-3">Email</label>
      <div class="col-sm-10 mt-3">
        <input type="text" class="form-control" id="staticEmail" value="{{ $user->email }}">
      </div>
      <label for="staticUnivers" class="col-sm-2 col-form-label mt-3">Учебное заведение</label>
      <div class="col-sm-10 mt-3">
        <input type="text" class="form-control" id="staticUnivers" value="{{ $user->univers }}">
      </div>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
  </form>
  @else
  <div class="form-group row">
    <label for="staticFio" class="col-sm-2 col-form-label">ФИО</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticFio" value="{{ $user->name }}">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label mt-3">Email</label>
    <div class="col-sm-10 mt-3">
      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $user->email }}">
    </div>
    <label for="staticUnivers" class="col-sm-2 col-form-label mt-3">Учебное заведение</label>
    <div class="col-sm-10 mt-3">
      <input type="text" readonly class="form-control-plaintext" id="staticUnivers" value="{{ $user->univers }}">
    </div>
  </div>
  @endif
</div>
@endsection
