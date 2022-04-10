@extends('layouts.main')

@section('content')
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" class="form-signin" action="{{ route('password.update') }}">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="text-center mb-4">
              <h1 class="h3 mb-3 font-weight-normal">Новый пароль</h1>
            </div>
            
            <x-label for="email" :value="__('Email')" />

            <div class="form-label-group">
              <input name="password" type="password" id="password" class="form-control" placeholder="Пароль" required autofocus>
              <label for="password">Пароль</label>
            </div>
            <div class="form-label-group">
              <input name="password_confirmation" type="password" id="password_confirmation" class="form-control" placeholder="Подтвердите пароль" required>
              <label for="password_confirmation">Подтвердите пароль</label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Отправить</button>
            </div>
        </form>
@endsection
