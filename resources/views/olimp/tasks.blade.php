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
                  @foreach ($tasks as $key => $task)
                  <div class="card mb-3">
                    <div class="card-header">
                      Задача №{{$key + 1}} @if(in_array($task->id, $answers_id)) - Ответ дан @endif
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">{{$task->title}}</h5>
                      <p class="card-text">{{$task->description}}</p>
                      <div class="d-flex align-items-end justify-content-between">
                        <a href="{{route('taskid', $task->id)}}" class="btn @if(in_array($task->id, $answers_id)) btn-success @else btn-primary @endif">Перейти к задаче</a>
                        <div class="">
                           Сложность: {{$task->diff}}
                        </div>
                      </div>

                    </div>
                  </div>
                  @endforeach
                </div>
            </div>
        </section>
@endsection
