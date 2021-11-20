@extends('layouts.main')

@section('content')

  <!-- Header-->
  <header class="bg-light py-3">
    <div class="container px-4 px-lg-5 my-3">
      <div class="text-center text-black">
        <h1 class="display-4 fw-bolder">Задачи</h1>
        <p class="lead fw-normal text-black-50 mb-0">Задачи расположены в порядке возрастания сложности</p>
      </div>
    </div>
  </header>
  <!-- Section-->
  <section class="py-3">
    <div class="container px-4 px-lg-5">
      <div class="row row-cols-1 mx-md-5 px-lg-5">
        @if(Auth::user()->role == 'admin')
          <a href="{{route('admin.tasks.add_form')}}" class="btn btn-primary my-3 w-100">Добавить задачу</a>
        @endif
        @foreach ($tasks as $task)
          <div class="card @if(Auth::user()->taskAnswer($task->id)->confirm??0) success @elseif(Auth::user()->taskAnswer($task->id)) info @endif mb-3">
            <div class="card-header">
              Задача №{{$loop->iteration}} @if(Auth::user()->taskAnswer($task->id)->confirm??0) - Ответ отправлен на проверку
              @elseif(Auth::user()->taskAnswer($task->id)) - Ответ сохранен @endif
            </div>
            <div class="card-body">
              <h5 class="card-title">{{$task->title}}</h5>
              <p class="card-text">{{$task->description_short}}</p>
              <div class="d-flex align-items-end justify-content-between">
                @if(!$task->trashed())
                <a href="{{route('tasks.task', $task->id)}}"
                   class="btn
                   @if(Auth::user()->taskAnswer($task->id)->confirm??0) btn-success @elseif(Auth::user()->taskAnswer($task->id)) btn-info @else btn-primary
                   @endif">
                  Перейти к задаче
                </a>
                @endif
                <div class="">
                  Сложность: {{$task->points}}
                </div>
                @if(Auth::user()->role == 'admin')
                  <div class="d-flex justify-content-end">
                    @if(!$task->trashed())
                    <a href="{{route('admin.tasks.edit_form', $task->id)}}" class="btn btn-success">Редактировать</a>
                    @endif
                    @if($task->trashed())
                      <form action="{{route('admin.tasks.restore', $task->id)}}" method="post">
                        @csrf
                        <button class="btn btn-warning ml-3" type="submit">Восстановить</button>
                      </form>
                    @else
                      <form action="{{route('admin.tasks.delete', $task->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger ml-3" type="submit">Удалить</button>
                      </form>
                    @endif
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
