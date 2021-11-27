@extends('layouts_comp.main')

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
      <form id="mainForm" class="form-group" enctype="multipart/form-data" action="@if(isset($task)) {{ route('admin.tasks.edit_post', $task->id) }} @else {{route('admin.tasks.add_post')}} @endif" method="post">
        @csrf
        @if(isset($success))
        <div class="alert alert-success mt-2 mb-0">
          {{$success}}
        </div>
        @endif
        <div class="row">
          <div class="col-8">
            <label for="nameTask">Название</label>
            <input type="text" name="title" class="form-control" id="nameTask" value="@if(isset($task)){{$task->title}}@endif">

          </div>
          <div class="col-4">
            <label for="category">Категория</label>
            <select class="form-control" id="category" name="category">
                <option @if(isset($task)) @if($task->category == 'Misc') selected @endif @endif>Misc</option>
                <option @if(isset($task)) @if($task->category == 'Forensic') selected @endif @endif>Forensic</option>
                <option @if(isset($task)) @if($task->category == 'Reverse') selected @endif @endif>Reverse</option>
                <option @if(isset($task)) @if($task->category == 'Pwn') selected @endif @endif>Pwn</option>
                <option @if(isset($task)) @if($task->category == 'Crypto') selected @endif @endif>Crypto</option>
            </select>
          </div>

        </div>

        <label for="flag">Флаг</label>
        <input type="text" name="flag" class="form-control" id="flag" value="@if(isset($task)){{$task->flag}}@endif">



          <label for="description">Условие задачи</label>
          <input type="hidden" name="description" id="description" value="@if(isset($task)){{$task->description}}@endif">
          <textarea class="form-control" name="" id="description_area" rows="5">@if(isset($task)){!!$task->description!!}@endif</textarea>

          <label for="points">Сложность</label>
          <select class="form-control" id="points" name="points">
            @for ($i = 100; $i <= 500; $i=$i+100)
                <option @if(isset($task)) @if($task->points == $i) selected @endif @endif>{{$i}}</option>
            @endfor
          </select>

            <input type="file" class="mt-3" name="file" id="file" aria-describedby="inputGroupFileAddon04">


        <div type="" id="submit" name="button" class="btn btn-primary w-100 my-4">Сохранить</div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/editor/0.1.0/editor.js"></script>
<script src="//cdn.jsdelivr.net/editor/0.1.0/marked.js"></script>
<script>
var editor = new Editor();
editor.render();

$("#submit").click(function(e) {
  $('.icon-preview').click();
  $('#description').val($('.editor-preview')[0].innerHTML);

  setTimeout(function() {
    $('form#mainForm').submit();
  }, 500);

});
</script>

@endsection
