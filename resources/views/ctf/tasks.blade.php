@extends('layouts_comp.main')

@section('styles')
<style media="screen">
  .card-title {
    font-size: 24pt;
    font-weight: 800;
  }
</style>
@endsection

@section('content')
  <!-- Section-->
  <section class="py-3">
    <div class="container px-4 px-lg-5">
      <div class="row row-cols-3 row-cols-md-5 mx-md-5 px-lg-5">
        @if(Auth::user()->role == 'admin')
          <a href="{{route('admin.tasks.add_form')}}" class="btn btn-primary my-3 w-100">Добавить задачу</a>
        @endif
        @foreach ($tasks as $task)
        <div class="col px-1 mb-3">
          <div class="card p-0 @if(Auth::user()->taskAnswer($task->id)) success @endif">
            <div class="card-body">
              <p class="card-text m-0">Web</p>
              <p class="card-title m-0">500</p>

              <div class="d-flex align-items-end justify-content-between">
                @if(!$task->trashed())
                <a href="{{route('tasks.task', $task->id)}}"
                   class="btn
                   @if(Auth::user()->taskAnswer($task->id)) btn-success @else btn-primary @endif">
                  Открыть
                </a>
                @endif
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
        </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
