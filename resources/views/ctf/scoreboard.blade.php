@extends('layouts.main')

@section('content')
<!-- Header-->
<header class="bg-light py-3">
  <div class="container px-4 px-lg-5 my-3">
    <div class="text-center text-black">
      <h1 class="display-4 fw-bolder">Статистика</h1>
      <p class="lead fw-normal text-black-50 mb-0"></p>
    </div>
  </div>
</header>
<!-- Section-->
<section class="py-3">
  <div class="container px-4 px-lg-5">

  <table class="table">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Название команды</th>
      <th scope="col">Учебное заведение</th>
      <th scope="col">Очки</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <th>{{$user->name}}</th>
        <th>{{$user->university}}</th>
        <th>{{$user->points()}}</th>
      </tr>
    @endforeach
    </tbody>
  </table>

  </div>
</section>
@endsection
