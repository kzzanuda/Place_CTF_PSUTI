@extends('layouts.main')

@section('content')
  <form method="POST" class="form-signin" action="{{ route('register') }}">
    @csrf
    <div class="text-center mb-4">
      <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
    </div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <div class="form-label-group">
      <input name="name" type="text" id="name" class="form-control" placeholder="ФИО" value="{{old('name')}}" required autofocus>
      <label for="name">ФИО</label>
    </div>
    <div class="form-label-group">
      <input name="univers" type="text" id="univers" class="form-control" placeholder="Наименование учебного заведения" value="{{old('univers')}}" required autofocus>
      <label for="univers">Наименование учебного заведения</label>
    </div>

    <div class="form-label-group">
      <input name="email" type="email" id="email" class="form-control" placeholder="Email" value="{{old('email')}}" required autofocus>
      <label for="email">Email</label>
    </div>

    <div class="form-label-group">
      <input name="password" type="password" id="password" class="form-control" placeholder="Пароль" value="{{old('password')}}" required>
      <label for="password">Пароль</label>
    </div>
    <div class="form-label-group">
      <input name="password_confirmation" type="password" id="password_confirmation" class="form-control" placeholder="Подтвердите пароль" value="{{old('password_confirmation')}}" required>
      <label for="password_confirmation">Подтвердите пароль</label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Регистрация</button>
    <div class="mt-2">Вы уже зарегистрированы?
      <a href="{{ route('login') }}"> Войти</a>
    </div>
  </form>
@endsection
