@extends('layouts.main')

@section('content')
<section class="py-3">
    <div class="container px-4 px-lg-5">
        <div class="row row-cols-1 mx-md-5 px-lg-5">
          <h3 class="text-center">{{$task->title}}</h3>
          {{$task->description_full}}<br>
          {{$answer->answer}}
        </div>
    </div>
</section>
@endsection
