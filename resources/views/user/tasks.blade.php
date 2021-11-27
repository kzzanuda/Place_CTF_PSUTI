@extends('layouts_comp.main')

@section('content')
<div class="container">
  <a href="{{ route('admin.users.list') }}" class="btn btn-outline-secondary m-3">Вернуться к списку пользователей</a>
  <h4>Ответы пользователя - {{$user->id}} {{$user->name}}</h4>
  <table class="table">
    <thead>
      <tr>
        <th scope="col"># Задачи</th>
        <th scope="col">Название задачи</th>
        <th scope="col">Описание задачи</th>
        <th scope="col">Получено баллов</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($answers as $answer)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <th>{{$answer->title}}</th>
        <th>{{$answer->description_short}}</th>
        <th>{{$answer->points}}</th>
        <th><a class="btn btn-primary" href="{{ route('admin.user_answer', [$user->id, $answer->task_id]) }}" role="button">Перейти к ответу</a></th>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
