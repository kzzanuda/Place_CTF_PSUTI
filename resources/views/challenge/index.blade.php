@extends('layouts.main')

@section('content')

  <!-- Header-->
  <header class="bg-light py-3">
    <div class="container px-4 px-lg-5 my-3">
      <div class="text-center text-black">
        <h1 class="display-4 fw-bolder">Квест</h1>
        <p class="lead fw-normal text-black-50 mb-0">Здесь вы можете сдать флаг и перейти на следующий уровень</p>
      </div>
    </div>
  </header>
  <!-- Section-->
  <section class="py-3">
    <div class="container px-4 px-lg-5">
      <div class="row justify-content-center">
        <form id="mainForm" class="mt-2 col-12 col-md-7" action="{{route('challenge.index')}}" method="post" disabled>
              @csrf
              <div class="form-group">
                  <input name="answer" class="form-control" id="answer">
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
              <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary mb-2">
                      Сдать флаг
                  </button>
              </div>
          </form>

          @foreach ($challenges as $challenge)
            <div class="mb-3 col-12 col-md-7">
              <div class="card-header">
                <span style="font-weight:700;">Уровень №{{$loop->iteration}} <a href="{{$challenge->url}}" target="_blank" class="ml-5 card-text">{{$challenge->url}}</a></span>
              </div>
            </div>
          @endforeach
      </div>

    </div>
  </section>
@endsection
