@extends('layouts.main')

@section('content')
<div class="container">
  <a href="{{ route('admin.users.list') }}" class="btn btn-outline-secondary m-3">Вернуться к списку пользователей</a>
  <div class="row mx-5 mb-3">
    @if(isset($previous))
    <a href="{{ route('admin.user_answers', $previous) }}" class="btn btn-outline-secondary col-5 mx-2">Предыдущий</a>
    @endif
    @if(isset($next))
    <a href="{{ route('admin.user_answers', $next) }}" class="btn btn-outline-secondary col-5 mx-2">Следующий</a>
    @endif
  </div>
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
      <tr @if($answer->confirm)class="confirm"@endif>
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
