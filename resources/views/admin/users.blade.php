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
      <th>{{$user->not_null_points()->count()}}</th>
      <th>{{$user->points()}}</th>
      <th><a class="btn btn-primary" href="{{ route('user_answers', $user->id) }}" role="button">Перейти к ответам</a></th>
      <th><a class="btn btn-danger" href="#" role="button">Заблокировать пользователя</a></th>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
