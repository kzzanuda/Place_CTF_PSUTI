@extends('layouts.main')

@section('content')
    <!-- Section-->
    <section class="py-3">
        <div class="container px-4 px-lg-5">
            <div class="row row-cols-1 mx-md-5 px-lg-5">
                <nav aria-label="..." class="d-flex justify-content-center mt-4 mb-3">
                    <ul class="pagination">
                        <li class="page-item @if(!$task->hasPrevious()) disabled @endif">
                            <a class="page-link"
                               href="@if($task->hasPrevious()) {{route('tasks.task', $task->previous())}} @else # @endif "
                               tabindex="-1">Предыдущая задача</a>
                        </li>
                        @foreach ($task->pagination() as $page)
                            <li class="page-item @if($task->id == $page) active @endif @if(Auth::user()->taskAnswer($page)->confirm??0) success
                              @elseif(Auth::user()->taskAnswer($page) != null) info @endif">
                                <a class="page-link" href="{{route('tasks.task', $page)}}">{{$loop->iteration}}</a>
                            </li>
                        @endforeach

                        <li class="page-item @if(!$task->hasNext()) disabled @endif">
                            <a class="page-link"
                               href="@if($task->hasNext()) {{route('tasks.task', $task->next())}} @else # @endif ">Следующая
                                задача</a>
                        </li>
                    </ul>
                </nav>
                <h3 class="text-center">{{$task->title}}</h3>
                @if(Auth::user()->role == "admin")
                    <div class="d-flex justify-content-end">
                        <a href="{{route('admin.tasks.edit_form', $task->id)}}" class="btn btn-success">Редактировать</a>
                      <form action="{{route('admin.tasks.delete', $task->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger ml-3" type="submit">Удалить</button>
                      </form>
                    </div>
                @endif
                @if(isset($success))
                    <div class="alert alert-success mt-2">
                        {{$success}}
                    </div>
                @endif
                {!! $task->description_full !!}
                <form id="mainForm" class="mt-2" action="{{route('tasks.answer', $task->id)}}" method="post" disabled>
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Введите ваш ответ в текстовое поле:</label>
                        <textarea name="answer" class="form-control" id="exampleFormControlTextarea1" rows="3" @if(Auth::user()->role != 'user' or Auth::user()->taskAnswer($task->id)->confirm??0) disabled @endif>{{Auth::user()->taskAnswer($task->id)->answer??''}}</textarea>
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
                    <input id="confirm" type="hidden" name="confirm" value="0">
                    <div class="d-flex justify-content-end">
                        @if(!(Auth::user()->taskAnswer($task->id)->confirm??false))
                        <button type="submit" class="btn btn-primary mb-2" @if(Auth::user()->role != 'user') disabled @endif>
                            Сохранить
                        </button>
                        <button type="button" data-toggle="tooltip" data-placement="left"
                        title="Это необходимо сделать до конца олимпиады, чтобы ответ был засчитан в системе, но пропадет возможность отредактировать ответ. Будьте внимательны!"
                        id="submitAnswer" class="btn btn-success mb-2 ml-3" @if(Auth::user()->role != 'user') disabled @endif>
                            Отправить на проверку
                        </button>
                        @else
                        <div class="text-center">
                          Ответ отправлен на проверку.
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
  $('#submitAnswer').click(function() {
      $('#confirm').val(1);
      $('#mainForm').submit();
  });
</script>
@endsection
