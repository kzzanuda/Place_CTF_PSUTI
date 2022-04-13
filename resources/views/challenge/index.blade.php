@extends('layouts.main')

@section('content')

  <!-- Header-->
  <header class="bg-light py-3">
    <div class="container px-4 px-lg-5 my-3">
      <div class="text-center text-black">
        <h1 class="display-4 fw-bolder">Квест</h1>
        <p class="lead fw-normal text-black-50">Здесь вы можете сдать флаг и перейти на следующий уровень</p>
        <p class="lead fw-normal text-black-50 mb-0">Не забудьте также об основных <a href="{{route('tasks.list')}}">задачах</a></p>
      </div>
    </div>
  </header>
  <!-- Section-->
  <section class="py-3">
    <div class="container px-4 px-lg-5">
      <div class="row justify-content-center">
        <form id="mainForm" class="mt-2 col-12 col-md-7" action="{{route('challenge.answer')}}" method="post" disabled>
              @csrf
              <p>В данном разделе вам предстоит поэтапно найти флаги в задачах, которые проверят ваши знания в разных областях ИБ. Следующая задача будет доступна только после сдачи флага от предыдущей. Удачи в поисках!</p>
              @if(isset($success))
                    <div class="alert alert-success mt-2">
                        {{$success}}
                    </div>
                @endif
                @if(isset($error))
                    <div class="alert alert-danger mt-2">
                        {{$error}}
                    </div>
                @endif
              <div class="form-group">
                  <input name="answer" class="form-control" id="exampleFormControlTextarea1" @if(Auth::user()->role != 'user' or $lvl === 'max') disabled @endif @if(isset($flag))value="{{$flag}}"@endif>
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
              <div class="d-flex justify-content-between">
                @if (Auth::user()->role === 'admin')
                <a href="{{route('admin.challenge.add_challenge')}}" class="btn btn-primary mb-4">
                  Добавить уровень
                </a>
                @endif
                <button type="submit" class="btn btn-primary mb-4" @if(Auth::user()->role != 'user' or $lvl === 'max') disabled @endif>
                    Сдать флаг
                </button>
              </div>
          </form>

          @foreach ($challenges as $challenge)
            <div class="mb-3 col-12 col-md-7">
              <div class="card-header">
                <span style="font-weight:700;">
                  Уровень №{{$loop->iteration}}
                  <a href="{{$challenge->url}}" target="_blank" class="ml-5 card-text">{{$challenge->url}}</a>
                  @if (Auth::user()->role === 'admin')
                  <a href="{{route('admin.challenge.edit_challenge', [$challenge->id])}}" class="float-right card-text">Редактировать</a>
                  @else
                  <span  class="float-right card-text">{{$challenge->title}}</span>
                  @endif
                </span>
              </div>
            </div>
          @endforeach
      </div>

    </div>
  </section>
@endsection
