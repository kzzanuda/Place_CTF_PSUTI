@extends('layouts.main')

@section('content')
    <form method="POST" class="form-signin" action="{{ route('login') }}">
        @csrf
      <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Вход</h1>
      </div>

      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <!-- Validation Errors -->
      <x-auth-validation-errors class="mb-4" :errors="$errors" />

      @if(Session()->get('message'))
        <div class="alert alert-success mt-2">
          {{Session()->get('message')}}
        </div>
      @endif

      <div class="form-label-group">
        <input name="name" type="text" id="inputName" class="form-control" value="{{old('name')}}" placeholder="Наименование команды" required autofocus>
        <label for="inputName">Наименование команды</label>
      </div>

      <div class="form-label-group">
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Пароль</label>
      </div>
      <div class="checkbox mb-2">
        <label>
          <input type="checkbox" value="remember-me"> Запомнить меня
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
      <div class="mt-2">У Вас нет профиля?
        <a href="{{ route('register') }}"> Регистрация</a>
      </div>
    </form>
@endsection
