@extends('layouts.main')

@section('content')
<div class="container">
  @if(1)
  <div class="row m-5 px-5">
    <div class="col-12">
      <h3>Меню админ панели</h3>
    </div>
    <div class="col-12">
      <a href="{{ route('admin_users') }}" class="btn btn-light font-weight-bold">Перейти к списку пользоавтелей</a>
    </div>
    <div class="col-12 mt-3">
      <a href="{{ route('admin_tasks') }}" class="btn btn-light rounded font-weight-bold">Перейти к списку задач и меню добавления задач</a>
    </div>
  </div>
  @elif(1)
  <div class="row m-5 px-5">
    <div class="col-12">
      <h3>Меню панели для жюри</h3>
    </div>
    <div class="col-12">
      <a href="{{ route('admin_users') }}" class="btn btn-light font-weight-bold">Перейти к списку пользоавтелей</a>
    </div>
    <div class="col-12 mt-3">
      <a href="{{ route('admin_tasks') }}" class="btn btn-light rounded font-weight-bold">Перейти к списку задач</a>
    </div>
  </div>
  @endif
</div>
@endsection