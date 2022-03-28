<x-guest-layout>
  <x-auth-card>
    <div style="text-align: center" class="pt-3">
      <x-slot name="logo">
        <a class="m-5" href="/">
          <img src="{{asset('storage/logo-white.png')}}" alt="logo" class="logo pt-3">
        </a>
      </x-slot>

      <div class="mb-4 text-sm text-gray-600">
        {{ __('Подтвердите почту, прежде чем продолжить участие в мероприятии.') }}
      </div>

      @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
          {{ __('Новое письмо было отправлено на почту, указанную в вашем профиле.') }}
        </div>
      @endif

      <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}" style="padding-bottom: 3rem">
          @csrf

          <div>
            <button type="submit" class="btn btn-lg btn-primary btn-block">
              {{ __('Выслать письмо повторно') }}
            </button>
          </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <button type="submit" class="btn btn-lg btn-block">
            {{ __('Выйти') }}
          </button>
        </form>
      </div>
    </div>
  </x-auth-card>
</x-guest-layout>
