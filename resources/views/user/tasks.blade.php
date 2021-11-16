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
    @foreach ($answers as $answer)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <th>{{$answer->title}}</th>
      <th>{{$answer->description_short}}</th>
      <th>{{$answer->points}}</th>
      <th><a class="btn btn-primary" href="{{ route('admin.user_answer', [$user_id, $answer->task_id]) }}" role="button">Перейти к ответу</a></th>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
