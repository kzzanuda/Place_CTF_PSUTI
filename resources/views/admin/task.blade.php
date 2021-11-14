@extends('layouts.main')

@section('content')
<div class="container">
  <div class="row mx-5 mt-2 px-5">
    <div class="col-12">
      <a href="{{ route('tasks.list') }}">Вернуться к задачам</a>
    </div>
    <div class="col-12 mt-3">
      @if(isset($task))
      <h3>Отредактировать задачу</h3>
      @else
      <h3>Добавить новую задачу</h3>
      @endif
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
    <div class="col-12">
      <form action="@if(isset($task)) {{ route('admin.tasks.edit_post', $task->id) }} @endif" method="post">
        @csrf
        <div class="form-group">
          <label for="nameTask">Название</label>
          <input type="text" name="title" class="form-control" id="nameTask" value="@if(isset($task)){{$task->title}}@endif">
        </div>
        <div class="form-group">
          <label for="description_short">Краткое описание</label>
          <textarea class="form-control" name="description_short" id="description_short" rows="2">@if(isset($task)){{$task->description_short}}@endif</textarea>
        </div>
        <div class="form-group">
          <label for="description_full">Условие задачи</label>
          <textarea class="form-control" name="description_full" id="description_full" rows="5">@if(isset($task)){{$task->description_full}}@endif</textarea>
        </div>
        <div class="form-group">
          <label for="points">Сложность</label>
          <select class="form-control" id="points" name="points">
            @for ($i = 1; $i <= 10; $i++)
                <option @if(isset($task)) @if($task->points == $i) selected @endif @endif>{{$i}}</option>
            @endfor
          </select>
        </div>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="file" aria-describedby="inputGroupFileAddon04">
            <label class="custom-file-label" for="file">Выбрать файл</label>
          </div>
        </div>
        @if (isset($success))
          <div class="alert alert-success mt-2 mb-0">
              Сохранено!
          </div>
        @endif
        <button type="submit" name="button" class="btn btn-primary w-100 my-4">Сохранить</button>
      </form>
    </div>
  </div>
</div>
@endsection
