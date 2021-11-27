@extends('layouts_comp.main')

@section('styles')
<style>
  #demo {
    font-size: 20pt;
  }
</style>
@endsection

@section('content')
<header class="bg-light py-3">
  <div class="container px-4 px-lg-5 my-3">
    <div class="text-center text-black">
      <h1 class="display-4 fw-bolder">Задачи</h1>
      <p class="lead fw-normal text-black-50 mb-0">Олимпиада еще не началась</p>
    </div>
  </div>
</header>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 d-flex justify-content-center flex-column text-center mt-4">
      <div class="">
        До начала олимпиады осталось:
      </div>
      <div class="mt-2" id="demo">

      </div>
      <div class="text-muted mt-4">
        Задания станут доступны сразу после начала
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('scripts')
<script>
// Set the date we're counting down to
var countDownDate = Date.parse('{{$time}}'); //.getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // If the count down is finished, write some text
  if (distance < 0) {
      clearInterval(x);
      location.reload();
      return;
  }

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + " дней " + hours + " часов "
  + minutes + " минут " + seconds + " секунд ";
}, 1000);
</script>
@endsection
