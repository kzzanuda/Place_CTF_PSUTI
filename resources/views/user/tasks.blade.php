@extends('layouts.main')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col"># Задачи</th>
      <th scope="col">Название задачи</th>
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
      <th><a class="btn btn-primary" href="#" role="button">Перейти к ответу</a></th>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
