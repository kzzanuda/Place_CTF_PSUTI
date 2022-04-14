@extends('layouts.main')

@section('styles')
<style media="screen">
  thead {
    background: #dee2e6;
  }
</style>
@endsection

@section('content')
<!-- Header-->
<header class="bg-light py-3">
  <div class="container px-4 px-lg-5 my-3">
    <div class="text-center text-black">
      <h1 class="display-4 fw-bolder">Результаты</h1>
      <p class="lead fw-normal text-black-50 mb-0"></p>
    </div>
  </div>
</header>
<!-- Section-->
<section class="py-3">
  <div class="container px-4 px-lg-5">

  <table class="table">
    <thead class="sticky-top">
    <tr class="sticky-top">
      <th scope="col">Место</th>
      <th scope="col">Наименование команды</th>
      <th scope="col">Учебное заведение</th>
      <th scope="col">Очков за задачи</th>
      <th scope="col">Очков за квест</th>
      <th scope="col">Всего очков</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
    {{--@if($user->points() !== 0)--}}
      <tr @if($user->id == Auth::user()->getAuthIdentifier()) style="background: green;color: #fff;" id="user" @endif>
        <th scope="row">{{$loop->iteration}}</th>
        <th>{{$user->name}}</th>
        <th>{{$user->university}}</th>
        <th>{{$user->pointsTasks()}}</th>
        <th>{{$user->pointsChallenge()}}</th>
        <th>{{$user->points()}}</th>
      </tr>
      {{--@endif--}}
    @endforeach
    </tbody>
  </table>

  </div>
</section>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('html,body').stop().animate({ scrollTop: $('#user').offset().top - 100 }, 1000);
  });
</script>
@endsection
