@extends('layouts.main')

@section('content')
<section class="py-3">
    <div class="container px-4 px-lg-5">
        <div class="row row-cols-1 mx-md-5 px-lg-5">
          <a href="#" class="btn btn-outline-secondary mb-5">Вернуться к списку ответов пользователя</a>
          <h3 class="text-center">{{$task->title}}</h3>
          Условие:<br>
          {{$task->description_full}}<br>
          <br>
          Ответ:<br>
          {{$answer->answer}}
          <div class="form-group mt-3">
            <label for="exampleFormControlSelect1">Количество баллов за задачу</label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <button type="button" class="btn btn-success">Проставить баллы</button>
          <a href="#" class="btn btn-danger mt-5">Удалить ответ</a>
        </div>
    </div>
</section>
@endsection
