@extends('layouts.main')

@section('styles')
<style>
  .clock {
    font-size: 30pt;
    font-weight: 600;
  }
</style>
@endsection

@section('content')
<!-- Header-->
<header class="bg-light py-3">
  <div class="container px-4 px-lg-5 my-3">
    <div class="text-center text-black">
      <h1 class="display-4 fw-bolder">Результаты</h1>
      <p class="lead fw-normal text-black-50 mb-0">Итоги еще не подведены</p>
    </div>
  </div>
</header>
<!-- Section-->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 d-flex justify-content-center flex-column text-center mt-4">
      <p class="clock">Результаты станут доступны сразу после выставления оценок всем участникам</p>
    </div>
  </div>
</div>
@endsection
