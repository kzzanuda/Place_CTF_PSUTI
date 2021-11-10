@extends('layouts.main')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ФИО</th>
      <th scope="col">email</th>
      <th scope="col">учебное заведение</th>
      <th scope="col">дано ответов</th>
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
      <th><a class="btn btn-primary" href="#" role="button">Перейти к ответам</a></th>
      <th><a class="btn btn-danger" href="#" role="button">Заблокировать пользователя</a></th>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
