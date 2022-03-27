@extends('layouts.main')

@section('content')
  <form method="POST" class="form-signin" action="{{ route('register') }}">
    @csrf
    <div class="text-center mb-4">
      <h1 class="h3 mb-3 font-weight-normal">Регистрация команды</h1>
    </div>
    @if(isset($success))
        <div class="alert alert-success mt-2">
            {{$success}}
        </div>
    @endif
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <div class="d-flex flex-column flex-md-row">

      <div class="w-100 w-md-50 mx-2">
        <div class="form-label-group">
          <input name="name" type="text" id="name" class="form-control" placeholder="ФИО" value="{{old('name')}}" required autofocus>
          <label for="name">Наименование команды</label>
        </div>
        <div class="form-label-group">
          <input name="university" type="text" id="university" class="form-control" placeholder="Наименование учебного заведения" value="{{old('university')}}" required autofocus>
          <label for="university">Наименование учебного заведения</label>
        </div>

        <div class="form-label-group">
          <input name="email" type="email" id="email" class="form-control" placeholder="Email" value="{{old('email')}}" required autofocus>
          <label for="email">Email капитана команды</label>
        </div>

        <div class="form-label-group">
          <input name="password" type="password" id="password" class="form-control" placeholder="Пароль" value="{{old('password')}}" required>
          <label for="password">Пароль</label>
        </div>

        <div class="form-label-group">
          <input name="password_confirmation" type="password" id="password_confirmation" class="form-control" placeholder="Подтвердите пароль" value="{{old('password_confirmation')}}" required>
          <label for="password_confirmation">Подтвердите пароль</label>
        </div>
      </div>

      <div class="w-100 w-md-50 mx-2">
        <div class="form-label-group">
          <input name="mem0" type="text" id="mem0" class="form-control" placeholder="ФИО капитана команды" value="{{old('mem0')}}" required>
          <label for="mem0">Группа и ФИО капитана команды</label>
        </div>

        @for ($i = 1; $i < 5; $i++)
        <div class="form-label-group">
          <input name="mem{{$i}}" type="text" id="mem{{$i}}" class="form-control" placeholder="Группа и ФИО учаcтника {{$i}}" value="{{old('mem$i')}}">
          <label for="mem{{$i}}">Группа и ФИО учаcтника {{$i}}</label>
        </div>
        @endfor
      </div>

    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Регистрация</button>
    <div class="mt-2">Вы уже зарегистрированы?
      <a href="{{ route('login') }}"> Войти</a>
    </div>
  </form>
@endsection
