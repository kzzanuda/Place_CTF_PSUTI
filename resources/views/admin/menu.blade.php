@extends('layouts.main')

@section('content')
<div class="container">
  <div class="row m-5 px-5">
    <div class="col-12">
      <h3>Меню админ панели</h3>
    </div>
    <div class="col-12">
      <a href="{{ route('admin.users.list') }}" class="btn btn-light font-weight-bold">Перейти к списку пользователей</a>
    </div>
    <div class="col-12 mt-3">
      <a href="{{ route('admin.tasks.list') }}" class="btn btn-light rounded font-weight-bold">Перейти к списку задач и меню добавления задач</a>
    </div>
  </div>
</div>
@endsection
