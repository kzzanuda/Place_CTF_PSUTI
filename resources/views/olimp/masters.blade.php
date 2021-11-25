@extends('layouts.main')

@section('content')
<!-- Header-->
<header class="bg-light py-3">
  <div class="container px-4 px-lg-5 my-3">
    <div class="text-center text-black">
      <h1 class="display-4 fw-bolder">Мастер-классы</h1>
      <p class="lead fw-normal text-black-50 mb-0">Здесь находятся презентации с прошедших мастер-классов</p>
    </div>
  </div>
</header>
<!-- Section-->
<section class="py-3">
  <div class="container px-4 px-lg-5">
    <div class="row" style="font-size:22pt;">
      <div class="col-12 d-flex justify-content-center mb-4">
        <a href="{{asset('storage/docs/Bypass_CSP.pdf')}}" download>
          Bypass_CSP <i class="bi-file-earmark-arrow-down h3"></i>
        </a>
      </div>
      <div class="col-12 d-flex justify-content-center">
        <a href="{{asset('storage/docs/Osobennosti_ib_na_krupnom_predpriyatii.pptx')}}" download>
          Особенности ИБ на крупном предприятии <i class="bi-file-earmark-arrow-down h3"></i>
        </a>
      </div>
    </div>
  </div>
</section>
@endsection
