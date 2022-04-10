@extends('layouts.main')

@section('content')

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        @if($errors->any())
          <div class="alert alert-danger">
              <ul class="m-0">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        @if (\Session::has('status'))
          <div class="alert alert-success">
              {!! \Session::get('status') !!}
          </div>
          @endif

        <form method="POST" class="form-signin" action="{{ route('password.email') }}">
            @csrf
            <div class="text-center mb-4">
              <h1 class="h3 mb-3 font-weight-normal">Забыли пароль?</h1>
            </div>
            <!-- Email Address -->

            <div class="form-label-group">
              <input name="email" type="text" id="inputName" class="form-control" value="{{old('email')}}" placeholder="Email" required autofocus>
              <label for="inputName">Email</label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Восстановить пароль по почте</button>
            </div>
        </form>
@endsection
