@extends('layouts.main')
@section('content')
<div class="px-5 my-5 container">
  <form action="@if($type === 'add') {{route('admin.challenge.save_challenge')}} @else {{route('admin.challenge.edit_challenge', [$challenge->id])}} @endif" method="POST">
    @csrf
    <div class="form-group row">
      <label for="title" class="col-sm-3 col-form-label">Название</label>
      <div class="col-sm-9">
        <input name="title" id="title" type="text" class="form-control" value="{{$challenge->title??''}}">
      </div>
      <label for="description" class="col-sm-3 col-form-label">Описание</label>
      <div class="col-sm-9">
        <input name="description" id="description" type="text" class="form-control" value="{{$challenge->description??''}}">
      </div>
      <label for="url" class="col-sm-3 col-form-label">Ссылка</label>
      <div class="col-sm-9">
        <input name="url" id="url" type="text" class="form-control" value="{{$challenge->url??''}}">
      </div>
      <label for="points" class="col-sm-3 col-form-label">Баллы</label>
      <div class="col-sm-9">
        <input name="points" id="points" type="number" min="0" class="form-control" value="{{$challenge->points??''}}">
      </div>
      <label for="answer" class="col-sm-3 col-form-label">Флаг</label>
      <div class="col-sm-9">
        <input name="answer" id="answer" type="text" class="form-control" value="{{$challenge->answer??''}}">
      </div>
    </div>
    <button type="submit" class="btn btn-primary mb-2">@if($type === 'add') Добавить @else Сохранить @endif</button>
  </form>
</div>
@endsection
