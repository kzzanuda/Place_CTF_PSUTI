@extends('layouts.main')

@section('styles')
<link rel="stylesheet" href="//cdn.jsdelivr.net/editor/0.1.0/editor.css">
@endsection

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
      <form id="mainForm" action="@if(isset($task)) {{ route('admin.tasks.edit_post', $task->id) }} @else {{route('admin.tasks.add_post')}} @endif" method="post">
        @csrf
        <div class="form-group">
          <label for="nameTask">Название</label>
          <input type="text" name="title" class="form-control" id="nameTask" value="@if(isset($task)){{$task->title}}@endif">
        </div>
        <div class="form-group">
          <label for="description_short">Краткое описание</label>
          <input style="height: 60px;" class="form-control" name="description_short" id="description_short" value="@if(isset($task)){{$task->description_short}}@endif" rows="2">
        </div>
        <div class="form-group">
          <label for="description_full">Условие задачи</label>
          <input type="hidden" name="description_full" id="description_full" value="@if(isset($task)){{$task->description_full}}@endif">
          <textarea class="form-control" name="" id="description_full_area" rows="5">@if(isset($task)){!!$task->description_full!!}@endif</textarea>
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
        <div class="alert alert-success mt-2 mb-0" id="success" hidden>
          Сохранено!
        </div>
        <button type="submit" name="button" class="btn btn-primary w-100 my-4">Сохранить</button>
      </form>
    </div>
  </div>
</div>
@endsection

@section('sripts')
<script src="//cdn.jsdelivr.net/editor/0.1.0/editor.js"></script>
<script src="//cdn.jsdelivr.net/editor/0.1.0/marked.js"></script>
<script>
var editor = new Editor();
editor.render();

$('#mainForm').submit(function(e) {
  e.preventDefault();
  $('.icon-preview').click();
  $('#description_full').val($('.editor-preview')[0].innerHTML);

  let data = $('#mainForm').serialize();

  $.ajax({
    url: '@if(isset($task)){{route('admin.tasks.edit_post', $task->id)}}@else{{route('admin.tasks.add_post')}}@endif',
    method: 'POST',
    data: data,
    success: function(data) {
      let success = document.getElementById('success');
      success.removeAttribute('hidden');
    }
  });
});
</script>
@endsection
