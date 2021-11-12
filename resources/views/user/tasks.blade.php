@extends('layouts.main')

@section('content')
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
    @foreach ($tasks as $key => $task)
    <tr>
      <th scope="row">{{$key+1}}</th>
      <th>{{$task->title}}</th>
      <th>{{$task->description_short}}</th>
      <th>{{$task->points}}</th>
      <th><a class="btn btn-primary" href="{{ route('user_answer', [$user_id, $task->id]) }}" role="button">Перейти к ответу</a></th>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
