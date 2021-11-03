@extends('layouts.main')

@section('content')

        <!-- Header-->
        <header class="bg-light py-3">
            <div class="container px-4 px-lg-5 my-3">
                <div class="text-center text-black">
                    <h1 class="display-4 fw-bolder">Задачи</h1>
                    <p class="lead fw-normal text-black-50 mb-0">Задачи расположены в порядке возрастания сложности</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-3">
            <div class="container px-4 px-lg-5">
                <div class="row row-cols-1">

                  <div class="card mb-3">
                    <div class="card-header">
                      Рекомендуемые
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Особое обращение с титулом</h5>
                      <p class="card-text">С вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту.</p>
                      <a href="#" class="btn btn-primary">Идти куда-нибудь</a>
                    </div>
                  </div>

                </div>
            </div>
        </section>
@endsection
