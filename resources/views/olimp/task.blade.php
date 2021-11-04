@extends('layouts.main')

@section('content')
        <!-- Section-->
        <section class="py-3">
            <div class="container px-4 px-lg-5">
                <div class="row row-cols-1 mx-md-5 px-lg-5">
                  <nav aria-label="..." class="d-flex justify-content-center mt-4 mb-3">
                    <ul class="pagination">

                      @if($id > 0)
                      <li class="page-item">
                        <a class="page-link" href="{{route('taskid', $tasks[$id-1]->id)}}" tabindex="-1">Предыдущая задача</a>
                      </li>
                      @else
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Предыдущая задача</a>
                      </li>
                      @endif
                      @foreach ($tasks as $key => $task)
                      <li class="page-item @if($task->id == $taskid->id) active @endif"><a class="page-link" href="{{route('taskid', $task->id)}}">{{$key + 1}}</a></li>
                      @endforeach
                      @if($id < count($tasks)-1)
                      <li class="page-item">
                        <a class="page-link" href="{{route('taskid', $tasks[$id+1]->id)}}">Следующая задача</a>
                      </li>
                      @else
                      <li class="page-item disabled">
                        <a class="page-link" href="#" aria-disabled="true">Следующая задача</a>
                      </li>
                      @endif
                    </ul>
                  </nav>
                  <h3 class="text-center">{{$taskid->title}}</h3>
                  @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                  @endif
                  {{$taskid->cond}}
                  <form class="mt-5" action="{{route('storeAnswer', $id)}}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Введите ваш ответ в текстовое поле:</label>
                      <textarea name="answer" class="form-control" id="exampleFormControlTextarea1" rows="3">@if($old_answer){{$old_answer[0]->answer}}@endif</textarea>
                    </div>
                    @if($errors->any())
                      <div class="alert alert-danger">
                          <ul class="m-0">
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                    @endif
                    <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary mb-2">Отправить</button>
                    </div>
                  </form>
                </div>
            </div>
        </section>
@endsection
