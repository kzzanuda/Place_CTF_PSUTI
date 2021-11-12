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
                  @if(Auth()->user()->role == 'admin')
                    <a href="{{route('admin_task')}}" class="btn btn-primary my-3 w-100">Добавить задачу</a>
                  @endif
                  @foreach ($tasks as $key => $task)
                  <div class="card @if(Auth()->user()->taskAnswer($task->id)) success @endif mb-3">
                    <div class="card-header">
                        Задача №{{$key + 1}} @if(Auth()->user()->taskAnswer($task->id)) - Ответ дан @endif
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">{{$task->title}}</h5>
                      <p class="card-text">{{$task->description_short}}</p>
                      <div class="d-flex align-items-end justify-content-between">
                        <a href="{{route('task', $task->id)}}" class="btn @if(Auth()->user()->taskAnswer($task->id)) btn-success @else btn-primary @endif">Перейти к задаче</a>
                        <div class="">
                           Сложность: {{$task->points}}
                        </div>
                        @if(Auth()->user()->role == 'admin')
                        <div class="">
                          <a href="{{route('admin_task', $task->id)}}" class="btn btn-success">Редактировать</a>
                          <a href="{{route('task', $task->id)}}" class="btn btn-danger">Удалить</a>
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
