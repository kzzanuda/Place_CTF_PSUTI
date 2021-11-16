@extends('layouts.main')

@section('content')
<section class="py-3">
    <div class="container px-4 px-lg-5">
        <div class="row row-cols-1 mx-md-5 px-lg-5">
          <a href="{{ route('admin.user_answers', $answer->user_id) }}" class="btn btn-outline-secondary mb-5">Вернуться к списку ответов пользователя</a>
          <h3 class="text-center">{{$task->title}}</h3>
          Условие:<br>
          {{$task->description_full}}<br>
          <br>
          Ответ:<br>
          {{$answer->answer}}
          <form class="" action="{{route('admin.add_points', [$answer->user_id, $task->id])}}" method="post">
            @csrf
            <div class="form-group mt-3">
              <label for="points">Количество баллов за задачу</label>
              <select name="points" class="form-control" id="points">
                @for ($i = 0; $i <= $task->points; $i++)
                    <option @if($answer->points == $i) selected @endif >{{$i}}</option>
                @endfor
              </select>
            </div>
            @if (\Session::has('success'))
              <div class="alert alert-success mb-2">
                  {!! \Session::get('success') !!}
              </div>
            @endif
            <button type="submit" class="btn btn-success w-100">Проставить баллы</button>
          </form>
          @if($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif


          <!-- <button type="button" class="btn btn-danger mt-5">Удалить ответ</button> -->
        </div>
    </div>
</section>
@endsection
