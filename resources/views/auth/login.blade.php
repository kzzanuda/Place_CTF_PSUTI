@extends('layouts.main')
{{--<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>--}}

@section('content')
<div class="card mb-2">
      <div class="card-body">
        <h3 class="m-0">Войти</h3>
      </div>
    </div>
    @if ($errors->any())
       <div class="alert alert-danger mb-2">
           <ul class="mb-0">
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
    @endif
    <div class="card">
      <div class="card-body">
        <div>
          <label for="username_email">Никнейм или E-mail</label>
          <input @input="changeInput" v-model="text" class="profile-input form-control mb-3" name="username_email" type="text" id="username_email">
        </div>  
        @if (Route::has('auth.register'))
        <div class="d-flex mb-2" style="font-size:1.05rem;">
          <p class="m-0">Еще нет аккаунта?</p>

          <a class="ml-2" href="{{ rroute('auth.register') }}">Зарегистрируйтесь</a>
          </a>

        </div>
        <hr>
        @endif
        @if (Route::has('auth.recovery'))
        <a href="{{ rroute('auth.recovery') }}" style="font-size:1.05rem;">
          Забыли пароль?
        </a>
        @endif

        <div class="custom-control custom-checkbox mt-2">
            <input type="checkbox" class="custom-control-input-orange" id="use-only-nickname" name="remeber">
            <label class="custom-control-label" for="use-only-nickname" style="font-size:1rem;">Запомнить меня</label>
        </div>

        <button-submit title="Войти" v-bind:disabled="disabled"></button-submit>

      </div>
    </div>
@endsection
