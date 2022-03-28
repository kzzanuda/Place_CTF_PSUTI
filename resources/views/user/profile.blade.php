@extends('layouts.main')

@section('styles')
  <style media="screen">
    .user {
      font-size: 15pt;
    }
    .user .title {
      font-weight: 600;
    }
    .w-80 {
      width: 80%;
      max-width: 700px;
      margin: 0 auto;
    }
  </style>
@endsection

@section('content')
<div class="px-5 my-5 container">
  <h2>Профиль</h2>
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
  @if (\Session::has('success'))
    <div class="alert alert-success">
        {!! \Session::get('success') !!}
    </div>
    @endif
    <form action="{{route('user.edit')}}" method="post">
          @csrf
          <div class="form-group row">
            <label for="staticFio" class="col-sm-3 col-form-label">Название команды (логин)</label>
            <div class="col-sm-9">
              <input name="name" type="text" class="form-control" id="staticFio" value="{{ $user->name }}">
            </div>
            <label for="staticEmail" class="col-sm-3 col-form-label mt-3">Email</label>
            <div class="col-sm-9 mt-3">
              <input name="email" type="text" class="form-control" id="staticEmail" value="{{ $user->email }}">
            </div>
            <label for="staticUnivers" class="col-sm-3 col-form-label mt-3">Учебное заведение</label>
            <div class="col-sm-9 mt-3">
              <input name="university" type="text" class="form-control" id="staticUnivers"
                     value="{{ $user->university }}">
            </div>
            <label for="staticCity" class="col-sm-3 col-form-label mt-3">Учебное заведение</label>
            <div class="col-sm-9 mt-3">
              <input name="city" type="text" class="form-control" id="staticCity"
                     value="{{ $user->city }}">
            </div>

            <label for="staticOldPassword" class="col-sm-3 col-form-label mt-3">Текущий пароль</label>
            <div class="col-sm-9 mt-3">
              <input name="old_password" type="password" class="form-control" id="staticOldPassword">
            </div>
            <label for="staticNewPassword" class="col-sm-3 col-form-label mt-3">Новый пароль</label>
            <div class="col-sm-9 mt-3">
              <input name="new_password" type="password" class="form-control" id="staticNewPassword">
            </div>
            <label for="staticNewConfirmPassword" class="col-sm-3 col-form-label mt-3">Подтвердите пароль</label>
            <div class="col-sm-9 mt-3">
              <input name="new_confirm_password" type="password" class="form-control" id="staticNewConfirmPassword">
            </div>
            @for($key = 0; $key < 5; $key++)
              <label for="mem{{$key}}" class="col-sm-3 col-form-label mt-3">
                @if($key == 0)
                Капитан команды
                @else
                Учатник команды #{{$key+1}}
                @endif
              </label>
              <div class="col-sm-9 mt-3">
                <input name="mem{{$key}}" type="text" class="form-control" id="mem{{$key}}" value="{{$user->getMembers()[$key]??''}}">
              </div>
            @endfor
          </div>
          <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
        </form>
      @else
        <div class="row user mt-4 text-center">
          <div class="col-4 title">
            Название команды
          </div>
          <div class="col-8">
            {{ $user->name }}
          </div>
          <div class="col-4 title">
            Учебное заведение
          </div>
          <div class="col-8">
            {{ $user->university }}
          </div>
        </div>
      @endif
    </div>
    {{--<div class="w-80">
      <table class="table">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Категория</th>
          <th scope="col">Очки</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($answers as $answer)
          <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$answer->category}}</td>
            <td>{{$answer->points}}</td>
          </tr>
        @endforeach
        <tr style="font-weight:800;">
          <th scope="row">#</th>
          <td>Сумма очков</td>
          <td>{{$user->points()}}</td>
        </tr>
        </tbody>
      </table>
    </div>--}}
  {{--@if($user->id == Auth::user()->getAuthIdentifier())
  <div class="mt-5">
    <a download href="{{route('certificate')}}">
      <button class="btn btn-primary">
        Скачать сертификат
      </button>
    </a>
  </div>
  @endif--}}
</div>
@endsection
