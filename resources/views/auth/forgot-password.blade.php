@extends('layouts.main')

@section('content')
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

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
