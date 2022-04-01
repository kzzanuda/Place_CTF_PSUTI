@extends('layouts.main')

@section('content')
  @if(Request::is('*/registered-by-city'))
    1
  @else
  <table class="table">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ФИО</th>
      <th scope="col">Email</th>
      <th scope="col">Учебное заведение</th>
      @if(Request::is('*/registered-by-city'))
        <th scope="col">Город</th>
        <th scope="col">Дата регистрации</th>
        <th scope="col">Подтверждение почты</th>
      @else
        <th scope="col">Дано ответов</th>
        <th scope="col">Сдано на проверку</th>
        <th scope="col">Проверено</th>
        <th scope="col">Набрано очков</th>
        <th scope="col"></th>
        <th scope="col"></th>
      @endif
    </tr>
    </thead>
    <tbody>

    @foreach ($users as $user)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <th>{{$user->name}}</th>
        <th>{{$user->email}}</th>
        <th>{{$user->university}}</th>
        @if(Request::is('*/registered-by-city'))
        <th>{{$user->city}}</th>
        <th></th>
        <th></th>
        @else
        <th>{{$user->answers()->count()}}</th>
        <th>{{$user->confirmAnswers()->count()}}</th>
        <th>{{$user->verified()->count()}}</th>
        <th>{{$user->points()}}</th>
        <th><a class="btn btn-primary" href="{{ route('admin.user_answers', $user->id) }}" role="button">Перейти к ответам</a>
        </th>
        <th>
          @if($user->active)
            <form action="{{route('admin.users.block', $user->id)}}" method="post">
              @csrf
              <button class="btn btn-danger" type="submit">Заблокировать</button>
            </form>
            {{--<a class="btn btn-danger" href="{{route('admin.users.block', $user->id)}}" role="button">Заблокировать</a>--}}
          @else
            <form action="{{route('admin.users.unblock', $user->id)}}" method="post">
              @csrf
              <button class="btn btn-danger" type="submit">Разблокировать</button>
            </form>
            {{--<a class="btn btn-danger" href="{{route('admin.users.unblock', $user->id)}}" role="button">Разблокировать</a>--}}
          @endif
        </th>
        @endif
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
