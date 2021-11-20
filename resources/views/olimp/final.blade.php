@extends('layouts.main')

@section('styles')
<style>
  .title {
    font-size: 32pt;
    font-weight: 800;
  }
</style>
@endsection

@section('content')
<header class="bg-light py-3">
  <div class="container px-4 px-lg-5 my-3">
    <div class="text-center text-black">
      <h1 class="display-4 fw-bolder">Задачи</h1>
      <p class="lead fw-normal text-black-50 mb-0">Олимпиада уже закончилась</p>
    </div>
  </div>
</header>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 d-flex justify-content-center flex-column text-center mt-4">
      <div class="title">
        Олимпиада закончилась. Задания недоступны.
      </div>
      <div class="mt-5">
         Объявление результатов 26 ноября.
      </div>
    </div>
  </div>
</div>
</div>
@endsection
