@extends('layouts.main')

@section('content')
  <table class="table">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ФИО</th>
      <th scope="col">Email</th>
      <th scope="col">Учебное заведение</th>
      <th scope="col">Дано ответов</th>
      <th scope="col">Проверено</th>
      <th scope="col">Набрано очков</th>
      <th scope="col">Заблокирован?</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $key => $user)
      <tr>
        <th scope="row">{{$key+1}}</th>
        <th>{{$user->name}}</th>
        <th>{{$user->email}}</th>
        <th>{{$user->university}}</th>
        <th>{{$user->answers()->count()}}</th>
        <th>{{$user->verified()->count()}}</th>
        <th>{{$user->points()}}</th>
        <th><i class="@if($user->active) bi-unlock @else bi-lock-fill @endif"></i></th>
        {{--TODO: нужно изменить роут--}}
        <th><a class="btn btn-primary" href="{{ route('tasks.list', $user->id) }}" role="button">Перейти к ответам</a>
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
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
