@extends('layouts.main')

@section('content')
        <!-- Section-->
        <section class="py-3">
            <div class="container px-4 px-lg-5">
                <div class="row row-cols-1 mx-md-5 px-lg-5">
                  <nav aria-label="...">
                    <ul class="pagination">
                      <li class="page-item disabled">
                        <a class="page-link" href="{{route('taskid', $taskid->id + 1)}}" tabindex="-1" aria-disabled="true">Предыдущая</a>
                      </li>
                      @foreach ($tasks as $key => $task)
                      <li class="page-item @if($key+1 == $taskid->id) active @endif"><a class="page-link" href="{{route('taskid', $task->id)}}">{{$key + 1}}</a></li>
                      @endforeach
                      <li class="page-item">
                        <a class="page-link" href="{{route('taskid', $taskid->id + 1)}}">Следующая</a>
                      </li>
                    </ul>
                  </nav>
                  {{$taskid->title}}
                  {{$taskid->description}}
                  {{$taskid->cond}}
                </div>
            </div>
        </section>
@endsection
