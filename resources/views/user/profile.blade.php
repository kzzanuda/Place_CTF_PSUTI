@extends('layouts_comp.main')

@section('content')
<div class="px-5 my-5 container">
  <h2>Профиль команды</h2>
  @if(Auth::user()->getAuthIdentifier() == $user->id)
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="m-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if (Session::has('success'))
    <div class="alert alert-success">
        {!! Session::get('success') !!}
    </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">
          {!! Session::get('error') !!}
        </div>
    @endif
  <form action="{{route('user.edit')}}" method="post">
    @csrf
    <div class="form-group row">
      <label for="staticFio" class="col-sm-2 col-form-label">Название команды</label>
      <div class="col-sm-10">
        <input name="name" type="text" class="form-control" id="staticFio" value="{{ $user->name }}">
      </div>
      <label for="staticEmail" class="col-sm-2 col-form-label mt-3">Email для входа</label>
      <div class="col-sm-10 mt-3">
        <input name="email" type="text" class="form-control" id="staticEmail" value="{{ $user->email }}">
      </div>
      <label for="staticUnivers" class="col-sm-2 col-form-label mt-3">Учебное заведение</label>
      <div class="col-sm-10 mt-3">
        <input name="university" type="text" class="form-control" id="staticUnivers" value="{{ $user->university }}">
      </div>
      <label for="staticOldPassword" class="col-sm-2 col-form-label mt-3">Текущий пароль</label>
      <div class="col-sm-10 mt-3">
        <input name="old_password" type="password" class="form-control" id="staticOldPassword">
      </div>
      <label for="staticNewPassword" class="col-sm-2 col-form-label mt-3">Новый пароль</label>
      <div class="col-sm-10 mt-3">
        <input name="new_password" type="password" class="form-control" id="staticNewPassword">
      </div>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
  </form>
  @else
  <div class="form-group row">
    <label for="staticFio" class="col-sm-2 col-form-label">Название команды</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticFio" value="{{ $user->name }}">
    </div>
    <label for="staticUnivers" class="col-sm-2 col-form-label mt-3">Учебное заведение</label>
    <div class="col-sm-10 mt-3">
      <input type="text" readonly class="form-control-plaintext" id="staticUnivers" value="{{ $user->university }}">
    </div>
  </div>
  @endif
</div>
@endsection
