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
      <form id="mainForm" class="form-group" enctype="multipart/form-data" action="@if(isset($task)) {{ route('admin.tasks.edit_post', $task->id) }} @else {{route('admin.tasks.add_post')}} @endif" method="post">
        @csrf
          <label for="nameTask">Название</label>
          <input type="text" name="title" class="form-control" id="nameTask" value="@if(isset($task)){{$task->title}}@endif">

          <label for="description_short">Краткое описание</label>
          <input style="height: 60px;" class="form-control" name="description_short" id="description_short" value="@if(isset($task)){{$task->description_short}}@endif" rows="2">

          <label for="description_full">Условие задачи</label>
          <input type="hidden" name="description_full" id="description_full" value="@if(isset($task)){{$task->description_full}}@endif">
          <textarea class="form-control" name="" id="description_full_area" rows="5">@if(isset($task)){!!$task->description_full!!}@endif</textarea>

          <label for="points">Сложность</label>
          <select class="form-control" id="points" name="points">
            @for ($i = 1; $i <= 30; $i++)
                <option @if(isset($task)) @if($task->points == $i) selected @endif @endif>{{$i}}</option>
            @endfor
          </select>

            <input type="file" class="mt-3 d-none" name="file" id="file" aria-describedby="inputGroupFileAddon04" onchange="renameLabel(this)">
            <label for="file" class="btn btn-primary mt-2" id="file_label">Загрузить новый файл</label>
            @if(isset($file_url) && $file_url)
              <div>
                Скачать ранее загруженный файл
                <a href="{{$file_url}}" download>
                  <i class="bi-file-earmark-arrow-down h2"></i>
                </a>
              </div>
            @endif

        <div class="alert alert-success mt-2 mb-0" id="success" hidden>
          Сохранено!
        </div>
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

// $('form#mainForm').submit(function(e) {
//   e.preventDefault();
//   $('.icon-preview').click();
//   $('#description_full').val($('.editor-preview')[0].innerHTML);
//
//   let data = new FormData(this);
//   console.log(data);
//
//   $.ajax({
//     url: '@if(isset($task)){{route('admin.tasks.edit_post', $task->id)}}@else{{route('admin.tasks.add_post')}}@endif',
//     method: 'POST',
//     data: data,
//     processData: false,
//     success: function(data) {
//       let success = document.getElementById('success');
//       success.removeAttribute('hidden');
//     }
//   });
// });

function renameLabel(input) {
  document.getElementById('file_label').innerHTML = input.files[0].name;
}

$("#submit").click(function(e) {
  $('.icon-preview').click();
  $('#description_full').val($('.editor-preview')[0].innerHTML);

  setTimeout(function() {
    $('form#mainForm').submit();
  }, 500);

});
</script>

@endsection
