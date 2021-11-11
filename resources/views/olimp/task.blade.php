@extends('layouts.main')

@section('content')
        <!-- Section-->
        <section class="py-3">
            <div class="container px-4 px-lg-5">
                <div class="row row-cols-1 mx-md-5 px-lg-5">
                  <nav aria-label="..." class="d-flex justify-content-center mt-4 mb-3">
                    <ul class="pagination">
                      <li class="page-item @if(!$task->hasPrevious()) disabled @endif">
                        <a class="page-link" href="@if($task->hasPrevious()) {{route('task', $task->previous())}} @else # @endif " tabindex="-1">Предыдущая задача</a>
                      </li>
                      @foreach ((new App\Models\Task)->pagination() as $key => $page)
                        <li class="page-item @if($task->id == $page) active @endif @if(Auth()->user()->taskAnswer($page) != null) success @endif">
                            <a class="page-link" href="{{route('task', $page)}}">{{$key + 1}}</a>
                        </li>
                      @endforeach

                      <li class="page-item @if(!$task->hasNext()) disabled @endif">
                        <a class="page-link" href="@if($task->hasNext()) {{route('task', $task->next())}} @else # @endif ">Следующая задача</a>
                      </li>
                    </ul>
                  </nav>
                  <h3 class="text-center">{{$task->title}}</h3>
                  @if("admin" == "admin")
                  <div class="d-flex justify-content-end">
                    <a href="{{route('task', $task->id)}}" class="btn btn-success">Редактировать</a>
                    <a href="{{route('task', $task->id)}}" class="btn btn-danger ml-3">Удалить</a>
                  </div>
                  @endif
                  {{$task->description_full}}
                    @if(isset($success))
                        <div class="alert alert-success mt-2">
                            {{$success}}
                        </div>
                    @endif
                  <form class="mt-2" action="{{route('to_answer', $task->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Введите ваш ответ в текстовое поле:</label>
                      <textarea name="answer" class="form-control" id="exampleFormControlTextarea1" rows="3">{{Auth()->user()->taskAnswer($task->id)->answer??''}}</textarea>
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
