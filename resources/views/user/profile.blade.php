@extends('layouts_comp.main')

@section('content')
<div class="px-5 my-5 container">
  <h2>Профиль</h2>
  @if(Auth::user()->getAuthIdentifier() == $user->id)
  @if($errors->any())
    <div class="alert alert-danger">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  @if (\Session::has('success'))
    <div class="alert alert-success">
        {!! \Session::get('success') !!}
    </div>
    @endif
  <form action="{{route('user.edit')}}" method="post">
    @csrf
    <div class="form-group row">
      <label for="staticFio" class="col-sm-2 col-form-label">ФИО</label>
      <div class="col-sm-10">
        <input name="name" type="text" class="form-control" id="staticFio" value="{{ $user->name }}">
      </div>
      <label for="staticGroup" class="col-sm-2 col-form-label">Группа</label>
      <div class="col-sm-10">
        <input name="group" type="text" class="form-control" id="staticGroup" value="{{ $user->group }}">
      </div>
      <label for="staticNum" class="col-sm-2 col-form-label">Номер зачетки</label>
      <div class="col-sm-10">
        <input name="numbook" type="text" class="form-control" id="staticNum" value="{{ $user->numbook }}">
      </div>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
  </form>
  @else
  <div class="form-group row">
    <label for="staticFio" class="col-sm-2 col-form-label">ФИО</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticFio" value="{{ $user->name }}">
    </div>
    <label for="staticGroup" class="col-sm-2 col-form-label">Группа</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control" id="staticGroup" value="{{ $user->group }}">
    </div>
  </div>
  @endif
</div>
  <div class="w-80">
    <table class="table">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Категория</th>
        <th scope="col">Очки</th>
      </tr>
      </thead>
      <tbody>
      @foreach ($answers as $answer)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$answer->category}}</td>
          <td>{{$answer->points}}</td>
        </tr>
      @endforeach
      <tr style="font-weight:800;">
        <th scope="row">#</th>
        <td>Сумма очков</td>
        <td>{{$user->points()}}</td>
      </tr>
      </tbody>
    </table>
  </div>
@endsection
